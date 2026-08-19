from zoneinfo import ZoneInfo

from telegram import Update
from telegram import Bot
from telegram.ext import Application, MessageHandler, filters, ContextTypes, CommandHandler
import requests
import json
import openaillm
from datetime import datetime, timezone

BOT_TOKEN = "8579550386:AAFrjNTRvVYTt78qisXsGWXH4B-87T1WUPM"
CHAT_ID = "8620933222"
DOMAIN = "http://127.0.0.1:8000"
API_TOKEN = "1|tEbmxxa9WCur7z6U3m0zBfOlyUcx8ebplAHeIWGe36e7e755"  # Replace with

CURRENT_CONVERSATION_ID = 1  # Replace with the ID of the conversation you want to use

def addMessage(role, content, message_type="text"):
    responseAPI = requests.post(
        f"{DOMAIN}/api/conversations/{CURRENT_CONVERSATION_ID}/addMessage",
        headers={
            "Authorization": f"Bearer {API_TOKEN}"
        },
        json={
            "role": role,
            "content": content,
            "message_type": message_type
        }
    )
    return responseAPI.json()

async def newConversation(update: Update, context: ContextTypes.DEFAULT_TYPE) -> None:
    responseAPI = requests.get(
        f"{DOMAIN}/api/characters",
        headers={
            "Authorization": f"Bearer {API_TOKEN}"
        },
        
    )
    characters = responseAPI.json()["data"]
    await update.message.reply_text(f"Select Character id. Available characters: {', '.join([char['character_name'] for char in characters])}")

async def newConversationWithChar(update: Update, context: ContextTypes.DEFAULT_TYPE) -> None:
    responseAPI = requests.post(
        f"{DOMAIN}/api/conversations",
        headers={
            "Authorization": f"Bearer {API_TOKEN}"
        },
        json={
            "character_id": context.args[0] if context.args else None,
            "timezone": "Asia/Jakarta",
            "locale": "id",
            "channel": "telegram",
            "title": f"Telegram Conversation with Character {context.args[0] if context.args else 'None'}",
        }
        
    )
    await update.message.reply_text(f"New conversation created with Character id: {context.args[0] if context.args else 'None'}. Conversation ID: {responseAPI.json()['conversation']['id']}")

    global CURRENT_CONVERSATION_ID
    CURRENT_CONVERSATION_ID = responseAPI.json()['conversation']['id']

def get_proactive_schedules():
    responseAPI = requests.get(
        f"{DOMAIN}/api/conversations/{CURRENT_CONVERSATION_ID}/proactiveSchedule",
        headers={
            "Authorization": f"Bearer {API_TOKEN}"
        },
    )
    return responseAPI.json()["data"]


async def proactive_job(context):
    print("[SYSTEM] Checking for proactive messages...")

    schedule = get_proactive_schedules()

    if schedule and not schedule['is_sent']:
        scheduled_time = datetime.fromisoformat(
            schedule['scheduled_at'].replace("Z", "+00:00")
        )

        current_time = datetime.now(timezone.utc)

        print(f"Scheduled: {scheduled_time}")
        print(f"Current:   {current_time}")

        if current_time >= scheduled_time:
            print("[SYSTEM] Proactive message is due!")

            # add the message to the conversation
            responseAPI = requests.get(
                f"{DOMAIN}/api/conversations/{CURRENT_CONVERSATION_ID}",
                headers={
                    "Authorization": f"Bearer {API_TOKEN}"
                },
            )
            conversation = responseAPI.json()["data"]

            # Ask the text model what to do
            responseAI = openaillm.generate_proactive_message(conversation, schedule['message'])

            responseAPI = addMessage(
                role="assistant",
                content=responseAI.output_text,
                message_type="text"
            )

            # sent the message to the user
            await context.bot.send_message(
                chat_id=CHAT_ID,
                text=responseAI.output_text,
            )

# print any message received by the bot
async def handle_message(update: Update, context: ContextTypes.DEFAULT_TYPE):
    user_input = update.message.text

    print(f"[USER]: {user_input}")

    responseAPI = addMessage(
        role="user",
        content=user_input,
        message_type="text"
    )

    conversation = responseAPI["conversation"]

    # print(f"conversation: {responseAPI.json()}")
    

    # --------------------------------------------------
    # Ask the text model what to do
    # --------------------------------------------------

    responseAI = openaillm.generate_response(conversation)

    

    # --------------------------------------------------
    # Process tool calls
    # --------------------------------------------------

    tool_was_called = False

    for item in responseAI.output:

        if item.type == "function_call":

            tool_was_called = True

            if item.name == "generate_image":

                arguments = json.loads(item.arguments)

                prompt = arguments["prompt"]

                # Execute our Python function
                image_path = openaillm.generate_image(conversation,prompt)

                # Give result back to text model
                responseAPI = addMessage(
                    role="system",
                    content="Image Successfully generated",
                    message_type="function_call_output"
                )

                conversation = responseAPI["conversation"]
                

                # use domain and url to send image to user
                with open(image_path, "rb") as f:
                    await update.message.reply_photo(
                        photo=f,
                        read_timeout=60,
                        write_timeout=60,
                        connect_timeout=60,
                        pool_timeout=60,
                        )

    # --------------------------------------------------
    # If a tool was called, ask the text model again
    # --------------------------------------------------

    if tool_was_called:

        final_response = openaillm.generate_response(conversation)

        responseAPI = addMessage(
            role="assistant",
            content=final_response.output_text,
            message_type="text"
        )


        await update.message.reply_text(final_response.output_text)

    else:

        responseAPI = addMessage(
                role="assistant",
                content=responseAI.output_text,
                message_type="text"
            )


        await update.message.reply_text(responseAI.output_text)


app = Application.builder().token(BOT_TOKEN).build()

app.add_handler(MessageHandler(filters.ALL, handle_message))

app.job_queue.run_repeating(
    proactive_job,
    interval=30,
    first=5
)

print("Bot is running...")
app.run_polling()

