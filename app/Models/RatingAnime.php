<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RatingAnime extends Model
{
    use HasFactory;
    protected $fillable = [
        'anime_id',
        'user_id',
        'stars',
    ];

    public function users()
{
    return $this->belongsTo(User::class);
}

public function animes()
{
    return $this->belongsTo(Anime::class);
}
}
