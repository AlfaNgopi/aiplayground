<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Conversation;

class ProactiveSchedule extends Model
{
    protected $table = 'proactive_schedules';

    protected $fillable = [
        'conversation_id',
        'scheduled_at',
        'message',
        'is_sent',
    ];

    protected $casts = [
        'scheduled_at' => 'datetime',
        'is_sent' => 'boolean',
    ];

    public function conversation()
    {
        return $this->belongsTo(Conversation::class);
    }
}
