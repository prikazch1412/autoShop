<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Services extends Model
{
    use HasFactory;

    protected $table = 'services';
    public $timestamps = false;

    protected $fillable = [
        'title'
    ];

    function items() {
        return $this->hasMany('App\Models\ServiceItems', 'service_id');
    }

    function itemsHesUsers() {
        return $this->hasMany('App\Models\UserHasServiceItems', 'service_id');
    }
}
