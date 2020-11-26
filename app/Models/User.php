<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use Notifiable, HasApiTokens;

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
        'description'
    ];

    protected $hidden = [
        'password',
    ];

    function services() {
        return $this->HasMany('App\Models\UserHasServices', 'user_id');
    }

    function serviceItems() {
        return $this->HasMany('App\Models\UserHasServiceItems', 'user_id');
    }

    function photos() {
        return $this->HasMany('App\Models\UserPhoto', 'user_id');
    }

    function orders() {
        return $this->HasMany('App\Models\Orders', 'user_id');
    }

    function reviews() {
        return $this->HasMany('App\Models\Reviews', 'user_id');
    }

    function cars() {
        return $this->HasMany('App\Models\UserCars', 'user_id');
    }
}
