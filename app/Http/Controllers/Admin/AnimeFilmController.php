<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Anime;
use App\Models\Anime_film;
use App\Models\anime_categorie;
use App\Models\Categorie;
use Illuminate\Support\Facades\Storage;

class AnimeFilmController extends Controller
{
    public function displayAnimeFilm(){
        $animeFilms = Anime_film::select('anime_films.*' , 'animes.titre as anime_titre' , 'animes.id as anime_id')
        ->join('animes' , 'anime_films.anime_id' , '=' , 'animes.id')
        ->where('anime_films.status', '=', 'showing')
        ->get();

        $animes = Anime::with('categories')->get();

        return view('Back-office.Admin.AnimeFilmTable' , compact('animeFilms' , 'animes'));
    }

    public function addAnimeFilm(Request $request){
        $request->validate([
            'titre' => 'required',
            'description' => 'required',
            'duration' => 'required',
            // 'posterLink' => 'required',
            // 'mediaLink' => 'required',
            'trailerLink' => 'required',
            'imbdLink' => 'required',
            'releaseYear' => 'required',
            'anime_id' => 'required',
        ]);

        if ($request->hasFile('posterLink')) {
        $pathPoster = $request->file('posterLink')->store('postersFilm ', 's3');
        }
        if ($request->hasFile('mediaLink')) {
        $pathMedia = $request->file('mediaLink')->store('mediasFilm ', 's3');
        }

        $animeFilm = new Anime_film();
        // $animeFilm->fill($request->all());    

        $animeFilm->titre = $request->titre;
        $animeFilm->description = $request->description;

        if ($request->hasFile('posterLink')) {
        $animeFilm->posterLink = Storage::disk('s3')->url($pathPoster);
        }

        $animeFilm->imbdLink = $request->imbdLink;
        $animeFilm->releaseYear = $request->releaseYear;
        $animeFilm->trailerLink = $request->trailerLink;
        if ($request->hasFile('mediaLink')) {
        $animeFilm->mediaLink = Storage::disk('s3')->url($pathMedia);
        }
        $animeFilm->duration = $request->duration;
        $animeFilm->anime_id = $request->anime_id;


        //   SSS Configurations
        $animeFilm->save();

        return redirect('/animeFilm')->with('status' , 'LAjoutage est Bien Faite !!');
    }

    public function updateAnimeFilm(Request $request){
        $request->validate([
            'titre' => 'required',
            'description' => 'required',
            'duration' => 'required',
            // 'poster' => 'required',
            // 'mediaLink' => 'required',
            'trailerLink' => 'required',
            'imbdLink' => 'required',
            'releaseYear' => 'required',
            'anime_id' => 'required',
        ]);

        if ($request->hasFile('posterLink')) {
            $pathPoster = $request->file('posterLink')->store('postersFilm ', 's3');
        }
         if ($request->hasFile('mediaLink')) {
            $pathMedia = $request->file('mediaLink')->store('mediasFilm ', 's3');
        }

        $animeFilm = Anime_film::find($request->id);
        // $animeFilm->fill($request->all());    

        $animeFilm->titre = $request->titre;
        $animeFilm->description = $request->description;

        if ($request->hasFile('posterLink')) {
        $animeFilm->posterLink = Storage::disk('s3')->url($pathPoster);
        }

        $animeFilm->imbdLink = $request->imbdLink;
        $animeFilm->releaseYear = $request->releaseYear;
        $animeFilm->trailerLink = $request->trailerLink;
        if ($request->hasFile('mediaLink')) {
        $animeFilm->mediaLink = Storage::disk('s3')->url($pathMedia);
        }
        $animeFilm->duration = $request->duration;
        $animeFilm->anime_id = $request->anime_id;
        if($request->status == 's'){
            $animeFilm->status = 'showing';
        }else{
            $animeFilm->status = 'hidden';
        }

        $animeFilm->update();

        return redirect('/animeFilm')->with('status' , 'La Modification Est Bien Faite !!');

    }

    public function hiddenAnimeFilm(Request $request){
        $request->validate([
            'id' => 'required',
        ]);
        $animeFilm = Anime_film::find($request->id);
        $animeFilm->status = 'hidden';
        $animeFilm->update();

        return redirect('/animeFilm')->with('status' , ' LAnime Films  Est Bien Caché !!');

    }
}
