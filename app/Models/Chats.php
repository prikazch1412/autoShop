<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Chats extends Model
{
    protected $table = 'chats';

    protected $fillable = [
        'user_id_1',
        'user_id_2'
    ];

    function messages() {
        return $this->hasMany('App\Models\Messages', 'chat_id');
    }
}
