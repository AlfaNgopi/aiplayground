<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Conversation;

class ConversationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $conversation1 = [
            'user_id' => 1,
            'character_id' => 1,
            'timezone' => 'Asia/Jakarta',
            'locale' => 'id',
            'title' => 'Debug Conversation',
            'status' => 'active',
            'last_message_at' => now(),
        ];
        Conversation::create($conversation1);

        $conversation2 = [
            'user_id' => 1,
            'character_id' => 2,
            'timezone' => 'Asia/Jakarta',
            'locale' => 'id',
            'title' => 'Debug Conversation',
            'status' => 'active',
            'last_message_at' => now(),
        ];
        // Conversation::create($conversation2);
    }
}
