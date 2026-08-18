<?php

namespace App\Http\Controllers;

use App\Models\Character;
use App\Models\Conversation;
use App\Models\Message;
use Illuminate\Http\JsonResponse;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class PlaygroundController extends Controller
{
    /**
     * Playground chat.
     */
    public function index(Request $request)
    {
        $user = $request->user();

        $characters = Character::query()
            ->where('user_id', $user->id)
            ->orderBy('character_name')
            ->get();

        $conversation = null;

        if ($request->filled('conversation')) {
            $conversation = Conversation::query()
                ->where('user_id', $user->id)
                ->where('id', $request->conversation)
                ->with([
                    'character',
                    'messages' => function ($query) {
                        $query->orderBy('created_at');
                    },
                ])
                ->first();
        }

        return view('playground.index', compact(
            'characters',
            'conversation'
        ));
    }

    /**
     * Create a new conversation.
     */
    public function createConversation(Request $request)
    {
        $validated = $request->validate([
            'character_id' => [
                'required',
                'integer',
                'exists:characters,id',
            ],
        ]);

        $user = $request->user();

        $character = Character::query()
            ->where('id', $validated['character_id'])
            ->where('user_id', $user->id)
            ->firstOrFail();

        $conversation = Conversation::create([
            'user_id' => $user->id,
            'character_id' => $character->id,
            'timezone' => $user->timezone ?? 'Asia/Jakarta',
            'locale' => 'id',
            'channel' => 'playground',
            'title' => $character->character_name,
            'status' => 'active',
            'last_message_at' => now(),
        ]);

        return response()->json([
            'success' => true,
            'conversation_id' => $conversation->id,
            'redirect' => route('playground.index', [
                'conversation' => $conversation->id,
            ]),
        ]);
    }

    /**
     * Send chat message.
     */
    public function send(Request $request)
    {
        $validated = $request->validate([
            'conversation_id' => [
                'required',
                'integer',
                'exists:conversations,id',
            ],
            'message' => [
                'required',
                'string',
                'max:10000',
            ],
        ]);

        $user = $request->user();

        $conversation = Conversation::query()
            ->where('id', $validated['conversation_id'])
            ->where('user_id', $user->id)
            ->with('character')
            ->firstOrFail();

        if (!$conversation->character) {
            return response()->json([
                'success' => false,
                'message' => 'Character untuk conversation ini tidak ditemukan.',
            ], 422);
        }

        $character = $conversation->character;

        /*
         * Simpan pesan user terlebih dahulu.
         */
        $userMessage = Message::create([
            'conversation_id' => $conversation->id,
            'role' => 'user',
            'content' => $validated['message'],
            'message_type' => 'text',
        ]);

        /*
         * Ambil history conversation.
         *
         * Dibatasi agar request ke OpenAI tidak terlalu besar.
         */
        $history = Message::query()
            ->where('conversation_id', $conversation->id)
            ->orderByDesc('created_at')
            ->limit(30)
            ->get()
            ->reverse()
            ->values();

        $messages = [];

        /*
         * System prompt dari character.
         */
        if (!empty($character->system_prompt)) {
            $messages[] = [
                'role' => 'system',
                'content' => $character->system_prompt,
            ];
        }

        /*
         * Tambahkan identitas character sebagai konteks tambahan.
         */
        $characterContext = [];

        if ($character->character_name) {
            $characterContext[] = "Nama karakter: {$character->character_name}";
        }

        if ($character->character_concept) {
            $characterContext[] = "Konsep karakter: {$character->character_concept}";
        }

        if (!empty($characterContext)) {
            $messages[] = [
                'role' => 'system',
                'content' => implode("\n", $characterContext),
            ];
        }

        /*
         * History chat.
         */
        foreach ($history as $message) {
            $role = match ($message->role) {
                'assistant' => 'assistant',
                'system' => 'system',
                default => 'user',
            };

            $messages[] = [
                'role' => $role,
                'content' => $message->content,
            ];
        }

        /*
         * Panggil OpenAI.
         */
        try {
            $response = Http::withToken(config('services.openai.key'))
                ->acceptJson()
                ->timeout(900)
                ->post('https://api.openai.com/v1/chat/completions', [
                    'model' => $character->ai_model ?: 'gpt-4o-mini',
                    'messages' => $messages,
                    'service_tier' => 'flex',
                ]);

            if ($response->failed()) {
                report(new \RuntimeException(
                    'OpenAI API Error: ' . $response->body()
                ));

                return response()->json([
                    'success' => false,
                    'message' => 'Gagal mendapatkan response dari OpenAI.',
                    'error' => $response->body(),
                ], 502);
            }

            $data = $response->json();

            $assistantContent =
                data_get($data, 'choices.0.message.content');

            if (!$assistantContent) {
                return response()->json([
                    'success' => false,
                    'message' => 'OpenAI tidak memberikan response.',
                ], 502);
            }

            /*
             * Simpan response assistant.
             */
            $assistantMessage = Message::create([
                'conversation_id' => $conversation->id,
                'role' => 'assistant',
                'content' => $assistantContent,
                'message_type' => 'text',
                'external_message_id' =>
                    data_get($data, 'id'),
            ]);

            /*
             * Update conversation.
             */
            $conversation->update([
                'last_message_at' => now(),
            ]);

            return response()->json([
                'success' => true,
                'user_message' => [
                    'id' => $userMessage->id,
                    'content' => $userMessage->content,
                ],
                'assistant_message' => [
                    'id' => $assistantMessage->id,
                    'content' => $assistantMessage->content,
                ],
            ]);
        } catch (\Throwable $e) {
            report($e);

            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan ketika menghubungi OpenAI.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}