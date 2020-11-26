<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserPhoto extends Model
{
    use HasFactory;

    protected $table = 'user_photo';
    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'src'
    ];
}
