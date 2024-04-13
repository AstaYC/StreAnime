<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Anime;
use App\Models\Anime_film;


class HiddenContentController extends Controller
{
    public function displayHiddenAnime(){
       $animes = Anime::where('status' , '=' , 'hidden')->get();
       return view('Back-office.Admin.HiddingAnimeTable' , compact('animes'));
    }

    public function recuperateAnime(Request $request){
        $request->validate([
            'id' => 'required'
        ]);

        $anime = Anime::find($request->id);
        $anime->status = 'showing';
        $anime->update();
    }

    public function deleteAnime(Request $request){
        $request->validate([
            'id' => 'required',
        ]);
        $anime = Anime::find($request->id);
        $anime->delete();
    }

    /////////////////////// FILM ///////////////////////////////


    public function displayHiddenAnimeFilm(){
       $films = Anime_film::where('status' , '=' , 'hidden')->get();
       return view('Back-office.Admin.HiddingAnimeFilmTable' , compact('films'));
    }

    public function recuperateAnimFilm(Request $request){
        $request->validate([
            'id' => 'required'
        ]);

        $films = Anime_film::find($request->id);
        $films->status = 'showing';
        $films->update();
    }

    public function deleteAnimeFilm(Request $request){
        $request->validate([
            'id' => 'required',
        ]);
        $films = Anime_film::find($request->id);
        $films->delete();
    }
}