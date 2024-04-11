<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Episode extends Model
{
    use HasFactory;
    protected $fillable = [
        'titre',
        'episodeNumber',
        'releaseYear',
        'posterLink',
        'imbdLink',
        'mediaLink',
        'duration',
        'episodeNumber',
        'season_id',
    ];
}
