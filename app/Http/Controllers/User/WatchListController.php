<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Anime;
use App\Models\Anime_film;
use App\Models\WatchList;
use Illuminate\Support\Facades\DB;

class WatchListController extends Controller
{
    public function addToWatchList(Request $request){
          $request->validate([
          ]);
          
          $watchLists = WatchList::where('user_id' , session('user_id'))->get();
          if(is_array($watchLists)){
            
            foreach($watchLists as $watchList){
                if($watchList->anime_id == $request->anime_id || $watchList->anime_film_id == $request->anime_film_id){
                 return back()->with('status', 'You have already rated this anime');
                }
           }
          
        }

          $watchList = new WatchList;
          
          if ($request->filled('anime_id')){
            $watchList->anime_id = $request->anime_id;
          }
          if($request->filled('anime_film_id')){
            $watchList->anime_film_id = $request->anime_film_id;
          }

          $watchList->save();
          
          return back()->with('status', 'Rating has been added');
        
        }

        public function removeFromWatchList(Request $request){
            
            if($request->filled('anime_id')){
              $watchList = WatchList::find($request->anime_id);
              $watchList->delete();
            }

            if($request->filled('anime_film_id')){
                $watchList = WatchList::find($request->anime_film_id);
                $watchList->delete();
            }
        }
}