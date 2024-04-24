<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnimeNews extends Model
{
    use HasFactory;
    protected $fillable = [
        'titre',
        'posterLink', 
        'date',
        'newsLink',
        'anime_id',
    ];
}
