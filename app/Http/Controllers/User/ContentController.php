<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use App\Models\Anime;
use App\Models\Anime_film;
use App\Models\Character;
use App\Models\Episode;
use App\Models\Season;
use App\Models\User;
use AWS\CRT\HTTP\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Hash;


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

        foreach ($trendanimes as $trendanime){
         $trendanime->Views = 0 ;
         $seasons = Season::where('anime_id', $trendanime->id)->get();
         foreach ( $seasons as $season){
           $season->episodesView = Episode::where('season_id', $season->id)->sum('views');
           $trendanime->Views +=  $season->episodesView;
         }
      }

        $trendanimeFilms = Anime_film::select('anime_films.*' , 'animes.id as anime_id' , 'animes.titre as anime_titre')
                                      ->join('animes' , 'anime_films.anime_id' , '=' , 'animes.id')
                                      ->orderBy('updated_at' , 'desc')
                                      ->take(6)
                                      ->get();


         ////////// THE most Film viewer ////////////

         $mostViewedFilms = Anime_film::orderBy('views' , 'DESC')
                                       ->take(6)
                                       ->get();


         /////// The Most Anime Viewer /////////////
         
         $animes = Anime::where('status'  , '=' , 'showing')
                          ->get(); 

         $animeWithTotal = new Collection();

         foreach ($animes as $anime){
            $anime->Views = 0 ;
            $seasons = Season::where('anime_id', $anime->id)->get();
            foreach ( $seasons as $season){
              $season->episodesView = Episode::where('season_id', $season->id)->sum('views');
              $anime->Views +=  $season->episodesView;
            }

         $animeWithTotal->push ([
            'anime' => $anime,
            'totalViews' => $anime->Views,
         ]);
         }
          
         $topAnimes = $animeWithTotal->sortByDesc('totalViews')->take(6);

         // //// last episodes ////
         $lastEpisodes = Episode::select('episodes.*' , 'animes.id as anime_id' , 'animes.titre as anime_titre')
                                  ->join('seasons' , 'seasons.id' , '=' , 'episodes.season_id')
                                  ->join('animes' , 'animes.id' , '=' , 'seasons.anime_id')
                                  ->orderBy('updated_at' , 'ASC')
                                  ->take(6)
                                  ->get();
      
        return view('Front-office.Home' , compact('animeSliders' , 'animeFilmsSliders' , 'animes' , 'trendanimes' , 'trendanimeFilms' , 'mostViewedFilms' , 'topAnimes' , 'lastEpisodes'));
     }

     public function displayAnimeList(){
       
        $animes = Anime::with('categories')
                  ->where('animes.status' , '=' , 'showing')
                  ->get();
         

         //  top Views Anime //
         $animeWithViews = new Collection();

         foreach ($animes as $anime){
            $anime->Views = 0 ;
            $seasons = Season::where('anime_id', $anime->id)->get();
            foreach ( $seasons as $season){
              $season->episodesView = Episode::where('season_id', $season->id)->sum('views');
              $anime->Views +=  $season->episodesView;
            }
            
            $animeWithViews ->push ([
               'anime' => $anime ,
               'totalViews' => $anime->Views
            ]);
         }

         $topAnimeVieweds = $animeWithViews->sortByDesc('totalViews')->take(10);

         //// Last Episode ///
        
         $lastEpisodes = Episode::select('episodes.*' , 'animes.id as anime_id' , 'animes.titre as anime_titre')
                                  ->join('seasons' , 'seasons.id' , '=' , 'episodes.season_id')
                                  ->join('animes' , 'animes.id' , '=' , 'seasons.anime_id')
                                  ->orderBy('updated_at' , 'ASC')
                                  ->take(10)
                                  ->get();
         
        return view('Front-office.AnimeList', compact('animes' , 'topAnimeVieweds' , 'lastEpisodes'));

     }

     public function displayAnimeFilmList(){
       
        $animeFilms = Anime_film::select('anime_films.*' , 'animes.id as anime_id' , 'animes.titre as anime_titre')
                                  ->join('animes' , 'anime_films.anime_id' , '=' , 'animes.id')
                                  ->where('anime_films.status' , '=' , 'showing')
                                  ->get();
        $animes = Anime::with('categories')->get();
        
        $topAnimeFilmViewers = $animeFilms->sortByDesc('views')
                                          ->take(8);
         
        $lastAnimeFilms = $animeFilms->sortByDesc('releaseYear')
                                     ->take(8);

        return view('Front-office.AnimeFilmList', compact('animeFilms' , 'animes' , 'topAnimeFilmViewers' , 'lastAnimeFilms'));

     }

     public function displayCharacterList(){
      $characters = Character::select('characters.*' , 'animes.id as anime_id' , 'animes.titre as anime_titre')
                               ->join('animes' , 'animes.id' , '=' , 'characters.anime_id')
                               ->get();

      $filmAssociés = Character::with('anime_films');
      
      return view('Front-office.CharacterList', compact('characters' , 'filmAssociés'));

     }


     public function displayUserProfil(){
      if(session('user_id')){
         $id = session('user_id');
         $user = User::select('users.*' , 'roles.nom as role_name')
                      ->join('roles' , 'roles.id' , '=' , 'users.role_id')
                      ->where('users.id' , $id)
                      ->first();
   
         return view('Front-office.UserProfil', compact('user'));
      }
      else{
         return redirect('/');
      }
   }
}