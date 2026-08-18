<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Character;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use App\Models\Conversation;
use App\Models\Message;

class CharacterAPI extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $user = $request->user();

        $characters = Character::all();

        return response()->json([
            'status' => 'success',
            'data' => $characters,
        ], 200);
    }

    
}