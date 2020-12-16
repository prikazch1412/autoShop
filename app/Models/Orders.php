<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    use HasFactory;

    protected $table = 'orders';

    protected $fillable = [
        'client_id',
        'user_id',
        'comment',
        'status',
        'time',
        'name',
        'phone',
        'car',
        'services',
        'email'
    ];

    function user() {
        return $this->belongsTo('App\Models\User', 'user_id');
    }
}
