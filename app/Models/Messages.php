<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Messages extends Model
{
    protected $table = 'messages';

    protected $fillable = [
        'text',
        'user_id',
        'chat_id'
    ];

    function user() {
        return $this->belongsTo('App\Models\User', 'user_id');
    }
}
