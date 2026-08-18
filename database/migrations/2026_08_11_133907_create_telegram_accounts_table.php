<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * telegram_accounts
     *-----------------
     *id
     *user_id
     *telegram_user_id
     *telegram_chat_id
     *username
     *first_name
     *last_name
     *is_active
     *created_at
     *updated_at
     */
    public function up(): void
    {
        Schema::create('telegram_accounts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('telegram_user_id')->unique();
            $table->string('telegram_chat_id')->unique();
            $table->string('username')->nullable();
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('telegram_accounts');
    }
};
