<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AnimeController extends Controller
{
    public function displayAnime(){
        return view('Front-office.index');
     }
     
     public function displayAnimeListe(){
         return view('Front-office.anime-lise');
      }
}
