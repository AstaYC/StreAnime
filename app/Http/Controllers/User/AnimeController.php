<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;

class AnimeController extends Controller
{
    public function displayAnime(){
        return view('Front-office.Home');
     }
     
     public function displayAnimeListe(){
         return view('Front-office.AnimeListe');
      }
}