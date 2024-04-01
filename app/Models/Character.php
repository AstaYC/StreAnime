<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Character extends Model
{
    use HasFactory;
    protected $fillable = [
        'nom' , 
        'glance' , 
        'anime_id'
    ];

    public function anime_film()
    {
        return $this->belongsToMany(Anime_film::class);
    }
}
