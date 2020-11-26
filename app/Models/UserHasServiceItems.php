<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserHasServiceItems extends Model
{
    use HasFactory;

    protected $table = 'user_has_service_items';
    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'service_item_id',
        'price'
    ];

    function item() {
        return $this->belongsTo('App\Models\ServiceItems', 'service_item_id');
    }
}
