from openai import OpenAI
import base64
import json
import os

client = OpenAI()

# --------------------------------------------------
# Image generation function
# --------------------------------------------------

def generate_image(prompt: str) -> str:
    print(f"\n🎨 Generating image with prompt: {prompt}...")

    result = client.images.generate(
        model="gpt-image-2",
        prompt=prompt,
        size="auto",
    )

    image_bytes = base64.b64decode(result.data[0].b64_json)

    # Create output directory
    os.makedirs("images", exist_ok=True)

    # Give each image a unique filename
    filename = f"images/image_{len(os.listdir('images')) + 1}.png"

    with open(filename, "wb") as f:
        f.write(image_bytes)

    print(f"✅ Image saved: {filename}")

    return filename


# --------------------------------------------------
# Tools available to the text model
# --------------------------------------------------

tools = [
    {
        "type": "function",
        "name": "generate_image",
        "description": (
            "Generate an image using an image generation model. "
            "Use this when the user explicitly asks to create, "
            "draw, generate, or visualize an image."
        ),
        "parameters": {
            "type": "object",
            "properties": {
                "prompt": {
                    "type": "string",
                    "description": "A detailed prompt describing the image to generate."
                }
            },
            "required": ["prompt"],
            "additionalProperties": False,
        },
        "strict": True,
    }
]


# --------------------------------------------------
# Conversation
# --------------------------------------------------

conversation = []

print("🤖 Chat started!")
print("Type 'quit' to exit.")
print("Try: Generate an image of a futuristic city at sunset.\n")


# --------------------------------------------------
# Main chat loop
# --------------------------------------------------

while True:

    user_input = input("You: ")

    if user_input.lower() in ["quit", "exit"]:
        break

    conversation.append({
        "role": "user",
        "content": user_input
    })

    # --------------------------------------------------
    # Ask the text model what to do
    # --------------------------------------------------

    response = client.responses.create(
        model="gpt-5.6-luna",
        input=conversation,
        tools=tools,
    )

    # Add model output to conversation
    conversation += response.output

    # --------------------------------------------------
    # Process tool calls
    # --------------------------------------------------

    tool_was_called = False

    for item in response.output:

        if item.type == "function_call":

            tool_was_called = True

            if item.name == "generate_image":

                arguments = json.loads(item.arguments)

                prompt = arguments["prompt"]

                # Execute our Python function
                image_path = generate_image(prompt)

                # Give result back to text model
                conversation.append({
                    "type": "function_call_output",
                    "call_id": item.call_id,
                    "output": json.dumps({
                        "success": True,
                        "image_path": image_path
                    })
                })

    # --------------------------------------------------
    # If a tool was called, ask the text model again
    # --------------------------------------------------

    if tool_was_called:

        final_response = client.responses.create(
            model="gpt-5.6-luna",
            input=conversation,
            tools=tools,
        )

        conversation += final_response.output

        print("\nAssistant:")
        print(final_response.output_text)
        print()

    else:

        print("\nAssistant:")
        print(response.output_text)
        print()