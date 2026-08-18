<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TelegramAccount extends Model
{
    //
    protected $table = 'telegram_accounts';

    protected $fillable = [
        'user_id',
        'telegram_user_id',
        'telegram_chat_id',
        'username',
        'first_name',
        'last_name',
        'is_active',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
