<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RatingAnimeFilm extends Model
{
    use HasFactory;
    protected $fillable = [
        'anime_film_id',
        'user_id',
        'stars',
    ];
    protected $table = 'rating_anime_film';


    public function anime_film(){
        return $this->belongsTo(Anime_film::class);
    }
    
    public function user(){
        return $this->belongsTo(User::class);
    }
}

