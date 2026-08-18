<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Character;

class CharacterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $char1 = [
            'user_id' => 1,
            'character_name' => 'Luna',
            'ai_model' => 'gpt-5.6-luna',
            'system_prompt' => 'Friendly and helpful assistant.',
            'is_proactive' => true,
            'proactive_intensity' => 5,
            'last_proactive_time' => now(),
            'quiet_start' => null,
            'quiet_end' => null,
        ];

        Character::create($char1);
    }
}
