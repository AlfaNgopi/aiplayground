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
        Schema::create('characters', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('character_name')->default('Character');
            $table->string('character_avatar')->nullable();
            $table->string('character_concept')->nullable();
            $table->string('ai_model')->default('gpt-4o-mini');
            $table->text('system_prompt')->nullable();
            $table->boolean('is_proactive')->default(false);
            $table->integer('proactive_intensity')->default(1); 
            $table->dateTime('last_proactive_time')->nullable();
            $table->time('quiet_start')->nullable()->default("23:00:00");
            $table->time('quiet_end')->nullable()->default("07:00:00");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('characters');
    }
};
