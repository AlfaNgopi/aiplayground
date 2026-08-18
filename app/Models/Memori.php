<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Memori extends Model
{
    //
    protected $table = 'memories';

    protected $fillable = [
        'user_id',
        'type',
        'content',
        'importance',
        'confidence',
        'expires_at',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
