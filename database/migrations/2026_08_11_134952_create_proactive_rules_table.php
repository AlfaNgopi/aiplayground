<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
        
    public function up(): void
    {
        Schema::create('proactive_rules', function (Blueprint $table) {
            $table->id();
            $table->foreignId('conversation_id')->constrained()->onDelete('cascade');
            $table->string('type')->nullable();
            $table->boolean('enabled')->default(true);
            $table->text('message_prompt')->nullable(); 
            // example: "this is a trigger for a proactive message in the morning, you should send a greeting message to the user"
            $table->string('start_natural_trigger_time')->nullable();
            $table->string('end_natural_trigger_time')->nullable();
            // trigger in random time between start and end time, if null then no time limit

            $table->string('follow_up_natural_trigger_time')->nullable();
            // trigger in random time after last message, if null then no follow up time limit


            $table->timestamp('last_triggered_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('proactive_rules');
    }
};
