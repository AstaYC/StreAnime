<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Anime_film extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'titre',
        'duration',
        'poster',
        'trailerLink',
        'mediaLink',
        'imbdLink',
        'releaseYear',
        'description',
        'mangaka',
        'studio',
        'status',
        'anime_id'
   ];

   public function characters()
   {
       return $this->belongsToMany(Character::class);
   }

   public function rating_animes()
   {
       return $this->hasMany(RatingAnimeFilm::class);
   }


}
