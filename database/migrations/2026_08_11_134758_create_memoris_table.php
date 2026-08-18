<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    // id
    // user_id
    // type
    // content
    // importance
    // confidence
    // expires_at
    // created_at
    // updated_at
    public function up(): void
    {
        Schema::create('memories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('conversation_id')->constrained()->onDelete('cascade');
            $table->string('type');
            $table->text('content');
            $table->integer('importance')->default(1);
            $table->integer('confidence')->default(1);
            $table->timestamp('expires_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('memories');
    }
};
