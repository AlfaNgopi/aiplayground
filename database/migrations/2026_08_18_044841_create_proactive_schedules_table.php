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
        Schema::create('proactive_schedules', function (Blueprint $table) {
            $table->id();
            $table->foreignId('conversation_id')->constrained()->onDelete('cascade');
            $table->timestamp('scheduled_at');
            $table->text('message')->default('this is a trigger for proactive message, you should use this for follow up uncompleted conversation, or to re-engage user, or greeting, or start a new conversation topic, or any other proactive message you want to send to the user. if starting a new conversation make sure it is the correct time for the topic. you may use image if you find it fitting, (selfie of dinner etc)');
            $table->boolean('is_sent')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('proactive_schedules');
    }
};
