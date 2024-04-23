<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\RatingAnime;
use App\Models\RatingAnimeFilm;
use Illuminate\Http\Request;

  class RatingSystemController extends Controller
{
    public function ratingAnime(Request $request){
        // dd($request);

        $request->validate([
            'id' => 'required',
            'stars' => 'required',
         ]);
         if(session('user_id')){
             $ratings = RatingAnime::where('user_id' , session('user_id'))->get();
             
             foreach ($ratings as $rating) {
                if ($rating->anime_id == $request->id){
    
                    $rating = RatingAnime::find($rating->id);
                    $rating->stars = $request->stars;
                    $rating->update();
    
                    return back()->with('status', 'Anime Rating updated successfully');
                }
             }
    
             $rating = new RatingAnime();
             $rating->anime_id = $request->id;
             $rating->user_id = session('user_id');
             $rating->stars = $request->stars;
             $rating->save();
    
             return back()->with('status', 'Rating has been added successfully');
         }else{
            return redirect('/login')->with('status', 'You are not allowed to Rating Anime');
         }
    }

    public function ratingAnimeFilm(Request $request){
         // dd($request);

        $request->validate([
            'id' => 'required',
            'stars' => 'required',
         ]);
         if(session('user_id')){
             $ratings = RatingAnimeFilm::where('user_id' , session('user_id'))->get();
             
             foreach ($ratings as $rating) {
                if ($rating->anime_film_id == $request->id){
    
                    $rating = RatingAnimeFilm::find($rating->id);
                    $rating->stars = $request->stars;
                    $rating->update();
    
                    return back()->with('status', 'Anime Film Rating updated successfully');
                }
             }
    
             $rating = new RatingAnimeFilm();
             $rating->anime_film_id = $request->id;
             $rating->user_id = session('user_id');
             $rating->stars = $request->stars;
             $rating->save();
    
             return back()->with('status', 'Rating has been added successfully');
         }else{
            return redirect('/login')->with('status', 'You are not allowed to Rating Anime Films');
         }
    }

}