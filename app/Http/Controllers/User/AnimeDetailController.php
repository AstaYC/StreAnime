<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AnimeDetailController extends Controller
{
    public function displayAnimeDetails(){
        return view('Front-office.AnimeDetails');
    }
}
