<?php

use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\ConversationAPI;
use App\Http\Controllers\Api\CharacterAPI;
use App\Http\Controllers\Api\AuthController;
use Illuminate\Support\Facades\Route;

Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/me', [UserController::class, 'me']);
    Route::get('/users', [UserController::class, 'index'])->middleware('role:admin');

    Route::get('/characters', [CharacterAPI::class, 'index']);

    Route::get('/conversations', [ConversationAPI::class, 'index']);
    Route::post('/conversations', [ConversationAPI::class, 'store']);
    Route::get('/conversations/{id}', [ConversationAPI::class, 'show']);
    Route::get('/conversations/{id}/proactiveSchedule', [ConversationAPI::class, 'proactiveSchedule']);

    Route::post('/conversations/{id}/addMessage', [ConversationAPI::class, 'addMessage']);
});
