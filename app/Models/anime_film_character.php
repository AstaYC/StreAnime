<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class anime_film_character extends Model
{
    use HasFactory;

    protected $fillable = [
         'anime_film_id',
         'character_id'
    ];

    protected $table = 'anime_film_character';
    
    public function anime_film()
    {
        return $this->belongsTo(Anime_film::class);
    }

    public function character()
    {
        return $this->belongsTo(Character::class);
    }
}
