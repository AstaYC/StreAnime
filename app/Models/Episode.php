<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Episode extends Model
{
    use HasFactory;
    protected $fillable = [
        'titre',
        'posterLink',
        'releaseYear',
        'mediaLink',
        'episodeNumber',
        'duration',
        'views',
        'season_id',
        'status'
    ];
}
