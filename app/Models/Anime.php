<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Anime extends Model
{
    use HasFactory;
    protected $fillable = [
        'titre',
        'poster',
        'trailerLink',
        'imbdLink',
        'releaseYear',
        'description',
        'mangaka',
        'studio',
        'source',
        'status',
    ];

    public function animeFilms()
    {
        return $this->hasMany(Anime_film::class);
    }
    
    public function categories()
    {
        return $this->belongsToMany(Categorie::class);
    }

    public function rating_animes()
{
    return $this->hasMany(RatingAnime::class);
}
}
