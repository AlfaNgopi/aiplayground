<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Conversation;

class ProactiveRules extends Model
{
    //
    // id
    // conversation_id
    // type
    // enabled
    // message_prompt
    // start_natural_trigger_time
    // end_natural_trigger_time
    // last_triggered_at
    // created_at
    // updated_at
    protected $table = 'proactive_rules';

    protected $fillable = [
        'conversation_id',
        'type',
        'enabled',
        'message_prompt',
        'start_natural_trigger_time',
        'end_natural_trigger_time',
        'last_triggered_at',
    ];

    protected $casts = [
        
        'last_triggered_at' => 'datetime',
    ];


    public function conversation()
    {
        return $this->belongsTo(Conversation::class);
    }
}
