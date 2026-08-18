<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */

        //     id
        // user_id
        // timezone
        // locale
        // channel
        // title
        // status
        // last_message_at
        // created_at
        // updated_at
    public function up(): void
    {
        Schema::create('conversations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('character_id')->nullable()->constrained('characters')->onDelete('set null');
            $table->string('timezone')->default('Asia/Jakarta');
            $table->string('locale')->default('id');
            // $table->string('channel');
            $table->string('title')->nullable();
            $table->string('status')->default('active');
            $table->timestamp('last_message_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('conversations');
    }
};
