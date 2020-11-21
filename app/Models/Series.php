<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Series extends Model
{
    use HasFactory;

    protected $table = 'series';
    public $timestamps = false;

    protected $fillable = [
        'model_id',
        'title',
        'start_year',
        'end_year'
    ];
}
