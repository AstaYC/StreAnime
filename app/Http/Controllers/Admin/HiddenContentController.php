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
       return view('Back-office.Admin.HiddenAnimeTable' , compact('animes'));
    }

    public function recuperateAnime(Request $request){
        $request->validate([
            'id' => 'required'
        ]);

        $anime = Anime::find($request->id);
        $anime->status = 'showing';
        $anime->update();

        return redirect('/hiddenAnime')->with('status' , 'La Recuperation est Bien Faite !!');

    }

    public function deleteAnime(Request $request){
        $request->validate([
            'id' => 'required',
        ]);
        $anime = Anime::find($request->id);
        $anime->delete();

        return redirect('/hiddenAnime')->with('status' , 'La SUppression est Bien Faite !!');

    }

    /////////////////////// FILM ///////////////////////////////


    public function displayHiddenAnimeFilm(){
       $Films = Anime_film::where('status' , '=' , 'hidden')->get();
       return view('Back-office.Admin.HiddenAnimeFilmTable' , compact('Films'));
    }

    public function recuperateAnimFilm(Request $request){
        $request->validate([
            'id' => 'required'
        ]);

        $films = Anime_film::find($request->id);
        $films->status = 'showing';
        $films->update();

        return redirect('/hiddenAnimeFilm')->with('status' , 'La Recuperation est Bien Faite !!');

    }

    public function deleteAnimeFilm(Request $request){
        $request->validate([
            'id' => 'required',
        ]);
        $films = Anime_film::find($request->id);
        $films->delete();

        return redirect('/hiddenAnimeFilm')->with('status' , 'La SUppression est Bien Faite !!');

    }
}