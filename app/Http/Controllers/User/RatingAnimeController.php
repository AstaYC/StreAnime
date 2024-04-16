<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\RatingAnime;
use Illuminate\Http\Request;

  class RatingAnimeController extends Controller
{
    public function addRating(Request $request){
         
        $request->validate([
            'id' => 'required',
            'starts' => 'required',
         ]);

         $ratings = RatingAnime::where('user_id' , session('user_id'))->get();
         foreach ($ratings as $rating) {
            if ($rating->anime_id == $request->id){
                return back()->with('status', 'You have already rated this anime');
            }
         }

         $rating = new RatingAnime();
         $rating->anime_id = $request->id;
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

         $rating = RatingAnime::where('user_id', session('user_id'))
                ->where('anime_id', $request->id)
                ->update(['starts' => $request->starts]);
    
    }

    public function deleteRating(Request $request) {
       
        $request->validate([
            'id' => 'required',
         ]);

         $rating = RatingAnime::where('user_id', session('user_id'))
                ->where('anime_id', $request->id)
                ->delete();

    }


    public function getAvgRatingAnime(){

    }

}