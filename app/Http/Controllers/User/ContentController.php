<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use App\Models\Anime;
use App\Models\Anime_film;

class ContentController extends Controller
{
    public function displayContent(){
        $animeSliders = Slider::select('sliders.*' , 'animes.titre as anime_titre' , 'animes.description as anime_description' , 'animes.posterLink')
                  ->join('animes' , 'sliders.anime_id' , '=' , 'animes.id')
                  ->whereNotNull('anime_id')
                  ->get();

        $animeFilmsSliders = Slider::select('sliders.*' , 'anime_films.titre as animeFilm_titre' , 'anime_films.description as animeFilm_description' , 'anime_films.posterLink' , 'animes.id as anime_id')
                  ->join('anime_films' , 'sliders.anime_film_id' , '=' , 'anime_films.id')
                  ->join('animes' , 'anime_films.anime_id' , '=' , 'animes.id')
                  ->orWhereNotNull('anime_film_id')
                  ->get();

        $animes = Anime::with('categories')->get();
        
        // Anime //
  
        $trendanimes = Anime::with('categories')
                             ->orderBy('updated_at' , 'desc')
                             ->take(9)
                             ->get();

        $trendanimeFilms = Anime_film::select('anime_films.*' , 'animes.id as anime_id' , 'animes.titre as anime_titre')
                                      ->join('animes' , 'anime_films.anime_id' , '=' , 'animes.id')
                                      ->orderBy('updated_at' , 'desc')
                                      ->take(6)
                                      ->get();

        return view('Front-office.Home' , compact('animeSliders' , 'animeFilmsSliders' , 'animes' , 'trendanimes' , 'trendanimeFilms'));
     }

     public function displayAnimeList(){
       
        $animes = Anime::with('categories')
                  ->where('animes.status' , '=' , 'showing')
                  ->get();
        return view('Front-office.AnimeList', compact('animes'));

     }

     public function displayAnimeFilmList(){
       
        $animeFilms = Anime_film::select('anime_films.*' , 'animes.id as anime_id' , 'animes.titre as anime_titre')
                                  ->join('animes' , 'anime_films.anime_id' , '=' , 'animes.id')
                                  ->where('anime_films.status' , '=' , 'showing')
                                  ->get();
        $animes = Anime::with('categories')->get();
        return view('Front-office.AnimeFilmList', compact('animeFilms' , 'animes'));

     }

     
}