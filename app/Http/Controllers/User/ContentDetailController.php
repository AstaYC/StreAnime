<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Anime;
use App\Models\Anime_film;
use App\Models\Character;
use App\Models\Episode;
use App\Models\Season;
use Illuminate\Http\Request;

class ContentDetailController extends Controller
{
    public function displayAnimeDetails($id){
        $anime = Anime::select('animes.*' , 'sources.nom as source_nom')
                 ->join('sources' , 'animes.source_id' , '=' , 'sources.id')
                 ->with('categories')
                 ->where('animes.id' , $id)
                 ->first();

        $seasons = Season::where('anime_id' , $id)
                         ->where('status', 'showing')
                         ->orderBy('seasonNumber', 'ASC')
                         ->get();

        $characters = Character::where('anime_id' , $id)
                                 ->get();

        return view('Front-office.AnimeDetails' , compact('anime' , 'seasons' , 'characters'));
    }


    public function displaySeasonDetails($id){
        
        $season = Season::select('seasons.*' , 'animes.titre as anime_titre' , 'animes.mangaka' , 'animes.studio' , 'sources.nom as source_nom')
                        ->join('animes' , 'animes.id' , '=' , 'seasons.anime_id')
                        ->join('sources' , 'sources.id' , '=' , 'animes.source_id')
                        ->where('seasons.id' , $id)
                        ->first();
        $anime = Anime::with('categories')->get();
        $episodes = Episode::where('season_id' , $id)
                            ->where('status' , 'showing')
                            ->orderBy('episodeNumber' , 'ASC')
                            ->get();


        return view('Front-office.SeasonDetails' , compact('season' , 'anime' , 'episodes'));
    }

    public function dispalyEpisodeWatching($id){
        $episode = Episode::select('episodes.*' , 'animes.titre as anime_titre' , 'seasons.titre as season_titre' , 'seasons.seasonNumber' , 'animes.id as anime_id')
                            ->join('seasons' , 'seasons.id' , 'episodes.season_id')
                            ->join('animes' , 'seasons.anime_id' , 'animes.id')
                            ->where('episodes.id' , $id)
                            ->first(); 

        return view('Front-office.EpisodeWatching' , compact('episode'));
    }


    //////// Film /////////

    public function displayAnimeFilmDetails($id){
        $animeFilm = Anime_film::select('anime_films.*' , 'animes.titre as anime_titre' , 'sources.nom as source_nom' , 'animes.mangaka' , 'animes.studio')
                                 ->join('animes' , 'animes.id' ,  '=' , 'anime_films.anime_id')
                                 ->join('sources' , 'sources.id' , '=' , 'animes.source_id')
                                 ->where('anime_films.id' , $id)
                                 ->first();

        $anime_id = $animeFilm->anime_id;

        $animes = Anime::with('categories');

        $animeFilmSimilars = Anime_film::select('anime_films.*' , 'animes.titre as anime_titre')
                                        ->join('animes' , 'animes.id' ,  '=' , 'anime_films.anime_id')
                                        ->where('anime_films.status', 'showing')
                                        ->where('anime_films.anime_id' , $anime_id)
                                        ->where('anime_films.id' , '!='  , $id)
                                        ->get();    
        
        return view('Front-office.AnimeFilmDetail' , compact('animeFilm' , 'animes' , 'animeFilmSimilars'));
    }   

    public function displayAnimeFilmWatching($id){
        
        $animeFilm = Anime_film::select('anime_films.*' , 'animes.titre as anime_titre')
                                 ->join('animes' , 'animes.id' ,  '=' , 'anime_films.anime_id')
                                 ->where('anime_films.id' , $id)
                                 ->first();

        return view('Front-office.AnimeFilmWatching' , compact('animeFilm'));

    }
}
