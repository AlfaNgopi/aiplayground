from datetime import datetime, timezone

from openai import OpenAI
import base64
import json
import os

client = OpenAI()

tools = [
    {
        "type": "function",
        "name": "generate_image",
        "description": (
            "Generate an image using an image generation model. "
            "Use this when the user explicitly asks to create, draw, generate, "
            "or visualize an image. The character may have a visual concept image "
            "available as a reference. Use that reference only when it is relevant "
            "or helpful for preserving the character's appearance, identity, "
            "clothing, proportions, or visual style. Do not force the reference "
            "into the generation when the user's request does not require it."
        ),
        "parameters": {
            "type": "object",
            "properties": {
                "prompt": {
                    "type": "string",
                    "description": "A detailed prompt describing the image to generate."
                },
                "use_character_reference": {
                    "type": "boolean",
                    "description": (
                        "Whether to use the character's visual concept image as a reference. "
                        "Set to true when maintaining the character's established appearance "
                        "is relevant; otherwise set to false."
                    )
                },
            },
            "required": ["prompt", "use_character_reference"],
            "additionalProperties": False,
        },
        "strict": True,
    }
]

# --------------------------------------------------
# Image generation function
# --------------------------------------------------

def generate_image(conversation, prompt: str, use_character_reference: bool = False) -> str:
    print(f"[AI]: Generating image {'with character reference' if use_character_reference else 'without character reference'} with prompt: {prompt[:50]}...")


    character = conversation['character']
    character_concept = character['character_concept']
    # character concept is a image that represents the character, we will use it as a base image for the image generation model
    # image_path = f'storage/{character_concept}'
    image_path = f"images/character.png"

    if True:  # use_character_reference:
        

        result = client.images.edit(
            image=open(image_path, "rb"),
            model="gpt-image-2",
            prompt=prompt,
            size="auto",
        )
    else:
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

def generate_response(conversation):

    character = conversation['character']
    model = character['ai_model']

    messages = []

    messages.append({
        "role": "system",
        "content": character['system_prompt']
    })

    for message in conversation['messages']:
        messages.append({
            "role": message['role'],
            "content": message['content']
        })

    print(f"[AI]: Generating response with model: {model}...")

    response = client.responses.create(
        model=model,
        input=messages,
        tools=tools,
        service_tier="flex",
    )
    print(f"[AI]: Response generated: {response.output_text[:50]}...")
    return response

def generate_proactive_message(conversation, proactive_prompt):
    character = conversation['character']
    model = character['ai_model']

    messages = []

    messages.append({
        "role": "system",
        "content": character['system_prompt']
    })

    for message in conversation['messages']:
        messages.append({
            "role": message['role'],
            "content": message['content']
        })

    messages.append({
        "role": "system",
        "content": f"current Time: {datetime.now(timezone.utc).isoformat()}\n {proactive_prompt}"
    })

    print(f"[AI]: Generating proactive message with model: {model}...")

    response = client.responses.create(
        model=model,
        input=messages,
        tools=tools,
        service_tier="flex",
    )
    return response
# --------------------------------------------------
# Tools available to the text model
# --------------------------------------------------


