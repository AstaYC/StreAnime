<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Anime;
use App\Models\Anime_film;
use App\Models\anime_categorie;
use App\Models\Categorie;

class AnimeFilmController extends Controller
{
    public function displayAnimeFilm(){
        $animeFilms = Anime_film::select('anime_films.*' , 'animes.titre as anime_titre')
        ->join('animes' , 'anime_films.anime_id' , '=' , 'animes.id')
        ->get();

        $animes = Anime::with('categorie')->get();

        return view('Back-office.Admin.AnimeFilmTable' , compact('animeFilms' , 'animes'));
    }

    public function addAnimeFilm(Request $request){
        $request->validate([
            'titre' => 'required',
            'description' => 'required',
            'duration' => 'required',
            'poster' => 'required',
            'mediaLink' => 'required',
            'traillerLink' => 'required',
            'imbdLink' => 'required',
            'releaseYear' => 'required',
        ]);

        $animeFilm = new Anime_film();
        // $animeFilm->fill($request->all());    

        $animeFilm->titre = $request->titre;
        $animeFilm->description = $request->description;
        $animeFilm->poster = $request->poster;
        $animeFilm->imbdLink = $request->imbdLink;
        $animeFilm->releaseYear = $request->releaseYear;
        $animeFilm->traillerLink = $request->traillerLink;
        $animeFilm->mediaLink = $request->mediaLink;
        $animeFilm->duration = $request->duration;

        //   SSS Configurations
        $animeFilm->save();

        return redirect('/anime')->with('status' , 'LAjoutage est Bien Faite !!');
    }

    public function updateAnimeFilm(Request $request){
        $request->validate([
            'titre' => 'required',
            'description' => 'required',
            'duration' => 'required',
            'poster' => 'required',
            'mediaLink' => 'required',
            'traillerLink' => 'required',
            'imbdLink' => 'required',
            'releaseYear' => 'required',
        ]);

        $animeFilm = Anime_film::find($request->id);
        // $animeFilm->fill($request->all());    

        $animeFilm->titre = $request->titre;
        $animeFilm->description = $request->description;
        $animeFilm->poster = $request->poster;
        $animeFilm->imbdLink = $request->imbdLink;
        $animeFilm->releaseYear = $request->releaseYear;
        $animeFilm->traillerLink = $request->traillerLink;
        $animeFilm->mediaLink = $request->mediaLink;
        $animeFilm->duration = $request->duration;

        $animeFilm->update();

        return redirect('/anime')->with('status' , 'La Modification Est Bien Faite !!');

    }

    public function deleteAnimeFilm(Request $request){
        $request->validate([
            'id' => 'required',
        ]);
        $animes = Anime::find($request->id);
        $animes->delete();
    }
}
