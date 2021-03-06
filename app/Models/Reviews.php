<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reviews extends Model
{
    use HasFactory;

    protected $table = 'reviews';

    protected $fillable = [
        'user_id',
        'client_id',
        'comment'
    ];

    function user() {
        return $this->belongsTo('App\Models\User', 'client_id');
    }
}
