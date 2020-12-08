<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    use HasFactory;

    protected $table = 'news';

    protected $fillable = [
        'title',
        'photo',
        'description'
    ];

    protected $casts = [
        'created_at' => 'datetime:Y.m.d',
        'updated_at' => 'datetime:Y.m.d',
    ];


    function comments() {
        return $this->hasMany('App\Models\Comments', 'news_id');
    }
}
