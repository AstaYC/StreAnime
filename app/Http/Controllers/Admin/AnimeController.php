<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Anime;

class AnimeController extends Controller
{
    public function displayAnime(){
        $animes = Anime::with('categories')->get();
    }
}
