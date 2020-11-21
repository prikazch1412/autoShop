<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'surname',
        'phone',
        'address',
        'photo',
        'service_name',
        'city_id',
        'user_role_id',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
    ];
}
