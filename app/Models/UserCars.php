<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserCars extends Model
{
    use HasFactory;

    protected $table = 'user_cars';

    protected $fillable = [
        'user_id',
        'model',
        'series',
        'year'
    ];
}
