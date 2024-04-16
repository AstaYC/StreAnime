<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Season extends Model
{
    use HasFactory;
    protected $fillable = [
        'titre',
        'description',
        'releaseYear', 
        'EndYear', 
        'posterLink',
        'traillerLink',
        'imbdLink',
        'seasonNumber',
        'anime_id',
        'status'
    ];
}
