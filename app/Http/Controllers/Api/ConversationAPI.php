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

        return response()->json([
            'status' => 'success',
            'data' => $message,
            'conversation' => $conversation,
        ], 200);
    }
}