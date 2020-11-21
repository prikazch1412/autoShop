<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserHasServices extends Model
{
    use HasFactory;

    protected $table = 'user_has_services';
    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'service_id'
    ];
}
