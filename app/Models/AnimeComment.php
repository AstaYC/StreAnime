<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnimeComment extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'anime_id', 
        'content'
    ];
}
