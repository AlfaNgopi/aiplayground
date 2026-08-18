<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    //
    protected $table = 'messages';

    protected $fillable = [
        'conversation_id',
        'role',
        'content',
        'message_type',
        'external_message_id',
    ];

    public function conversation()
    {
        return $this->belongsTo(Conversation::class);
    }

    public function attachments()
    {
        return $this->hasMany(MessageAttachment::class);
    }
}
