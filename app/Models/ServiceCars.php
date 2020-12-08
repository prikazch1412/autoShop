<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceCars extends Model
{
    use HasFactory;

    protected $table = 'service_has_cars';
    public $timestamps = false;

    protected $fillable = [
        'model_id',
        'user_id'
    ];

    function car() {
        return $this->belongsTo('App\Models\Models', 'model_id');
    }
}
