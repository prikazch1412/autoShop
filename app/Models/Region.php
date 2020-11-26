<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    use HasFactory;

    protected $table = 'regions';
    public $timestamps = false;

    protected $fillable = [
        'title'
    ];

    function city() {
        return $this->hasMany('App\Models\City', 'region_id');
    }
}
