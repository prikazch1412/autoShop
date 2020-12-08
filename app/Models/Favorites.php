<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Favorites extends Model
{
    use HasFactory;

    protected $table = 'favorites';
    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'favorite_user_id'
    ];

    function user() {
        return $this->belongsTo('App\Models\User', 'favorite_user_id');
    }
}
