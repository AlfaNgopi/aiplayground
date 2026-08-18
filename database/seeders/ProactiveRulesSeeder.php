<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ProactiveRules;

class ProactiveRulesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $proactive1 = [
            'conversation_id' => 1,
            'type' => 'scheduled',
            'enabled' => true,
            'message_prompt' => 'this is a trigger for a proactive message in the morning, you should send a greeting message to the user',
            'start_natural_trigger_time' => '08:00:00', // 8 AM
            'end_natural_trigger_time' => '10:00:00', // 10 AM
            'last_triggered_at' => null,
        ];
        ProactiveRules::create($proactive1);

        $proactive2 = [
            'conversation_id' => 1,
            'type' => 'follow-up',
            'enabled' => true,
            'message_prompt' => 'this is a trigger for a proactive ',
            'follow_up_natural_trigger_time' => '04:00:00', // 4 hours after last message
            'last_triggered_at' => null,
        ];
        
        ProactiveRules::create($proactive2);
    }
}
