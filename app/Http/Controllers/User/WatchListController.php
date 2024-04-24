<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Anime;
use App\Models\Anime_film;
use App\Models\WatchAnimeFilmList;
use App\Models\WatchAnimeList;

class WatchListController extends Controller
{
    public function addToAnimeWatchList(Request $request){
          // dd($request);
          $request->validate([
            'id' => 'required',
           ]);
          
          $watchLists = WatchAnimeList::where('user_id' , session('user_id'))->get();
          
          if($watchLists){  
            foreach($watchLists as $watchList){
              if($watchList->anime_id == $request->id){
                $watchList->delete();
                return back()->with('status', 'Removed From Watch List');
              }
           }
        }

          $watchList = new WatchAnimeList;
          $watchList->user_id = session('user_id');
          $watchList->anime_id = $request->id;
          $watchList->save();
          
          return back()->with('status', 'Added To Watch List');
        
        }

    public function addToAnimeFilmWatchList(Request $request){
          $request->validate([
            'id' => 'required',
           ]);
          
          $watchLists = WatchAnimeFilmList::where('user_id' , session('user_id'))->get();
          
          if($watchLists){
            
            foreach($watchLists as $watchList){
              if($watchList->anime_film_id == $request->id){
                $watchList->delete();
                return back()->with('status', 'Removed From Watch List');
              }
           }
        }

          $watchList = new WatchAnimeFilmList;
          $watchList->user_id = session('user_id');
          $watchList->anime_film_id = $request->id;
          $watchList->save();
          
          return back()->with('status', 'Added To Watch List');
        
        }


        public function displayWatchList(){

          $animes = Anime::select('animes.*')
                    ->with('categories')
                    ->join('watch_anime_lists', 'watch_anime_lists.anime_id' , '=' , 'animes.id')
                    ->where('animes.status', '=' , 'showing')
                    ->where('watch_anime_lists.user_id' , session('user_id'))
                    ->get();
                    // foreach ($animes as $anime){
                    //   dd($anime->categories);
                    // }
          $animeFilms = Anime_film::select('anime_films.*' , 'animes.id as anime_id' , 'animes.titre as anime_titre')
                    ->join('animes' , 'anime_films.anime_id' , '=' , 'animes.id')
                    ->join('watch_anime_film_lists', 'watch_anime_film_lists.anime_film_id' , '=' , 'anime_films.id')
                    ->where('anime_films.status' , '=' , 'showing')
                    ->where('watch_anime_film_lists.user_id' , session('user_id'))
                    ->get();
          $filmsCategories = Anime::with('categories')
                            ->get();

          return view('Front-office.WatchList' , compact('animes' , 'animeFilms' , 'filmsCategories'));
        }
}