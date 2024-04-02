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
        'status',
    ];
    
    public function categories()
    {
        return $this->belongsToMany(Categorie::class);
    }
}
