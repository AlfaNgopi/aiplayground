<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use App\Models\Conversation;
use App\Models\Message;
use App\Models\Character;

class ConversationAPI extends Controller
{

    public function index(Request $request): JsonResponse
    {
        $user = $request->user();

        $conversations = $user->conversations()->with('character')->get();

        return response()->json([
            'status' => 'success',
            'data' => $conversations,
        ], 200);
    }

    public function store(Request $request): JsonResponse
    {
        $user = $request->user();

        $validatedData = $request->validate([
            'character_id' => 'required|exists:characters,id',

        ]);

        $conversation = Conversation::create([
            'user_id' => $user->id,
            'character_id' => $validatedData['character_id'],

            'last_message_at' => now(),
        ]);

        return response()->json([
            'status' => 'success',
            'conversation' => $conversation,
        ], 201);
    }

    public function show(Request $request, int $id): JsonResponse
    {
        $user = $request->user();

        $conversation = $user->conversations()->with('character', 'messages')->findOrFail($id);

        return response()->json([
            'status' => 'success',
            'data' => $conversation,
        ], 200);
    }

    public function addMessage(Request $request, int $id): JsonResponse
    {
        $user = $request->user();

        $conversation = $user->conversations()->findOrFail($id);



        $message = $conversation->messages()->create([
            'role' => $request->input('role'),
            'content' => $request->input('content'),
            'message_type' => $request->input('message_type'),
        ]);

        $conversation->load('messages', 'character');

        $this->schedulingProactiveMessage($conversation);

        return response()->json([
            'status' => 'success',
            'data' => $message,
            'conversation' => $conversation,
        ], 200);
    }

    private function schedulingProactiveMessage(Conversation $conversation): void
    {

        $intensity = $conversation->character->proactive_intensity;
        // intensity 0 - 10, 0 means no proactive message, 10 means very frequent proactive messages
        // very frequent mean at least 1 proactive message every 1 hour, and at least 10 per day

        if ($intensity <= 0) {
            return;
        }

        $lastMessage = $conversation->messages()->latest()->first();
        $lastMessageTime = $lastMessage ? $lastMessage->created_at : now();

        $meanMinutes = (60 * 10) / $intensity;

        // Exponential distribution with this mean.
        $u = mt_rand() / mt_getrandmax();
        $minutesToAdd = (int) round(-log(1 - $u) * $meanMinutes);

        $minutesToAdd = max(5, $minutesToAdd);

        $scheduledTime = $lastMessageTime->copy()->addMinutes($minutesToAdd);

        //if the latest proactive message is already sent, create a new one, otherwise, update the existing one
        $latestProactiveSchedule = $conversation->proactiveSchedules()->latest()->first();
        if ($latestProactiveSchedule && $latestProactiveSchedule->is_sent) {
            $latestProactiveSchedule->update([
                'scheduled_at' => $scheduledTime,
                'message' => 'this is a trigger for proactive message, you should use this for follow up uncompleted conversation, or to re-engage user, or greeting, or start a new conversation topic, or any other proactive message you want to send to the user, if starting a new conversation make sure it is the correct time for the topic. you may use image if you find it fitting, (selfie of dinner etc)',
                'is_sent' => false,
            ]);
            return;
        }
        else if ($latestProactiveSchedule && !$latestProactiveSchedule->is_sent) {
            $latestProactiveSchedule->update([
                'scheduled_at' => $scheduledTime,
                'message' => 'this is a trigger for proactive message, you should use this for follow up uncompleted conversation, or to re-engage user, or greeting, or start a new conversation topic, or any other proactive message you want to send to the user, if starting a new conversation make sure it is the correct time for the topic. you may use image if you find it fitting, (selfie of dinner etc)',
                'is_sent' => false,]);
            return;
        }

        $conversation->proactiveSchedules()->create([
            'scheduled_at' => $scheduledTime,
            'message' => 'this is a trigger for proactive message, you should use this for follow up uncompleted conversation, or to re-engage user, or greeting, or start a new conversation topic, or any other proactive message you want to send to the user, if start a conversation make sure it correct time for the topic. you may use image if you find it fitting, (selfie of dinner etc)',
            'is_sent' => false,
        ]);
    }

    public function proactiveSchedule(Request $request, int $id): JsonResponse
    {
        $user = $request->user();

        $conversation = $user->conversations()->findOrFail($id);

        $proactiveSchedule = $conversation->proactiveSchedules()->latest()->first();

        return response()->json([
            'status' => 'success',
            'data' => $proactiveSchedule,
        ], 200);
    }
}
