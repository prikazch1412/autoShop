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
        'description',
        'status'
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

    function myFavorites() {
        return $this->HasMany('App\Models\Favorites', 'user_id');
    }

    function favorites() {
        return $this->HasMany('App\Models\Favorites', 'favorite_user_id');
    }

    function userRole() {
        return $this->belongsTo('App\Models\UserRoles', 'user_role_id');
    }

    function serviceCars() {
        return $this->HasMany('App\Models\ServiceCars', 'user_id');
    }
}
