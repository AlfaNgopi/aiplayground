<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MessageAttachment extends Model
{
    //

    protected $table = 'message_attachments';

    protected $fillable = [
        'message_id',
        'type',
        'storage_disk',
        'storage_path',
        'mime_type',
        'file_size',
        'width',
        'height',
        'telegram_file_id',
        'telegram_file_unique_id',
    ];

    public function message()
    {
        return $this->belongsTo(Message::class);
    }
}
