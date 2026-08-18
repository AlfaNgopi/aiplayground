<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Character extends Model
{
    protected $table = 'characters';
    protected $fillable = [
        'user_id',
        'character_name',
        'character_avatar',
        'character_concept',
        'ai_model',
        'system_prompt',
        'is_proactive',
        'proactive_intensity',
        'last_proactive_time',
        'quiet_start',
        'quiet_end',
    ];

    protected $casts = [
        'is_proactive' => 'boolean',
        'last_proactive_time' => 'datetime',
        
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function conversations()
    {
        return $this->hasMany(Conversation::class);
    }
}
