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
        // anime View //
        $seasonsForAnimes = Season::where('anime_id' , $id)
                         ->get();
        $animeViews = 0 ;     
       
        foreach($seasonsForAnimes as $seasonsForAnime){
            $SeasonViews = Episode::where('episodes.season_id', $seasonsForAnime->id)
                          ->sum('views');
            $animeViews = $animeViews + $SeasonViews ;
        }
  
        $seasons = Season::where('anime_id' , $id)
                         ->where('status', 'showing')
                         ->orderBy('seasonNumber', 'ASC')
                         ->get();

        foreach ($seasons as $season) {
            $season->seasonViews = Episode::where('episodes.season_id', $season->id)
                                          ->sum('views');
        }

        $characters = Character::where('anime_id' , $id)
                                 ->get();
    
        $filmAssociés = Character::with('anime_films');


        return view('Front-office.AnimeDetails' , compact('anime' , 'seasons' , 'characters' , 'animeViews' , 'filmAssociés'));
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

        $views = Episode::where('episodes.season_id' , $season->id)
                          ->sum('views');

        return view('Front-office.SeasonDetails' , compact('season' , 'anime' , 'episodes' , 'views'));
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
                                
        $characters = $animeFilm->characters;       
        return view('Front-office.AnimeFilmDetail' , compact('animeFilm' , 'animes' , 'animeFilmSimilars' , 'characters'));
    }   

    public function displayAnimeFilmWatching($id){
        
        $animeFilm = Anime_film::select('anime_films.*' , 'animes.titre as anime_titre')
                                 ->join('animes' , 'animes.id' ,  '=' , 'anime_films.anime_id')
                                 ->where('anime_films.id' , $id)
                                 ->first();

        return view('Front-office.AnimeFilmWatching' , compact('animeFilm'));
    }

 /////  Incriment Episode View ////////

    public function viewsIncriment($episodeId){

        $episode = Episode::find($episodeId);

        if($episode->status == 'hidden'){
            return response()->json(['error' => 'This Episode is hidden'], 200);
        }

        $episode->views = $episode->views + 1 ;
        $episode->update();

        return response()->json(['message' => 'Views count incremented successfully'], 200);
    }

/////  Incriment AnimeFilm View ////////

public function viewsFilmsIncriment($filmId){

    $film = Anime_film::find($filmId);

    if($film->status == 'hidden'){
        return response()->json(['error' => 'This film is hidden'], 200);
    }

    $film->views = $film->views + 1 ;
    $film->update();

    return response()->json(['message' => 'Views count incremented successfully'], 200);
}
}
