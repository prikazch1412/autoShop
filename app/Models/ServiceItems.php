<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceItems extends Model
{
    use HasFactory;

    protected $table = 'service_items';
    public $timestamps = false;

    protected $fillable = [
        'title',
        'service_id'
    ];

    function items() {
        return $this->hasMany('App\Models\ServiceItems', 'service_id');
    }
}
