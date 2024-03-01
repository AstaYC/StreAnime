<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AnimeDetailController extends Controller
{
    public function displayAnimeDetails(){
        return view('Front-office.anime-details');
    }
}
