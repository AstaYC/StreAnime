<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\RatingAnimeFilm;
use Illuminate\Http\Request;

  class RatingAnimeFilmController extends Controller
{
    public function addRating(Request $request){
         
        $request->validate([
            'id' => 'required',
            'starts' => 'required',
         ]);

         $ratings = RatingAnimeFilm::where('user_id' , session('user_id'))->get();
         foreach ($ratings as $rating) {
            if ($rating->anime_id == $request->id){
                return back()->with('status', 'You have already rated this anime');
            }
         }

         $rating = new RatingAnimefilm();
         $rating->anime_film_id = $request->id;
         $rating->user_id = $request->session('user_id');
         $rating->starts = $request->starts;
         $rating->save();

         return back()->with('status', 'Rating has been added');
    }


    public function updateRating(Request $request) {
        
        $request->validate([
            'id' => 'required',
            'starts' => 'required',
         ]);

         $rating = RatingAnimeFilm::where('user_id', session('user_id'))
                ->where('anime_id', $request->id)
                ->update(['starts' => $request->starts]);
    
    }

    public function deleteRating(Request $request) {
       
        $request->validate([
            'id' => 'required',
         ]);

         $rating = RatingAnimeFilm::where('user_id', session('user_id'))
                ->where('anime_id', $request->id)
                ->delete();
    }


    public function getAvgRatingAnime(){

    }

}