<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Anime;
use App\Models\Anime_film;
use App\Models\Slider;
use Illuminate\Support\Facades\DB;

class SliderController extends Controller
{
//   public function displaySliderUI (){
//     $sliders = Slider::select('sliders.*', 'animes.titre as aTitre', 'animes.poster as aPoster', 'animes.description as aDesc', 'anime_films.titre', 'anime_films.id as film_id', 'anime_films.poster', 'anime_films.description' , 'anime_films.anime_id')
//     ->join('animes', 'sliders.media_id', '=', 'animes.id')
//     ->join('anime_films', 'sliders.media_id', '=', 'anime_films.id')
//     ->get();
// }
  public function displaySlider(){
    $animeSliders = Slider::select('sliders.*', 'animes.titre', 'animes.posterLink')
    ->join('animes', 'sliders.anime_id', '=', 'animes.id')
    ->whereNotNull('sliders.anime_id')
    ->get();

    $filmSliders = Slider::select('sliders.*', 'anime_films.titre', 'anime_films.posterLink')
    ->join('anime_films', 'sliders.anime_film_id', '=', 'anime_films.id')
    ->whereNotNull('sliders.anime_film_id')
    ->get();

    $animes = Anime::select('animes.id as anime_id' , 'animes.titre as anime_titre')->get();
    $films = Anime_film::select('anime_films.id as film_id' , 'anime_films.titre as film_titre' , 'animes.titre as anime_titre')
    ->join('animes' , 'anime_films.anime_id' , '=' , 'animes.id')
    ->get();

    /////// delete the null sliders
  
    $sliders = Slider::all();
    
    foreach ($sliders as $slider){
      if ($slider->anime_id === null && $slider->anime_film_id === null){
        $slider->delete();
      }
    }
    
    // $otakus = $animes->merge($films);
    
    return view('Back-office.Admin.SliderTable' , compact('animeSliders' ,'filmSliders' ,'animes' , 'films'));
  }

  public function addSlider (Request $request){
    $request->validate([
    ]);

    $slider = new Slider();
    if($request->filled('anime_id')){   
      $slider->anime_id = $request->anime_id;
    }

    if($request->filled('anime_film_id')){   
      $slider->anime_film_id = $request->anime_film_id;
    }

    $slider->save();

    return redirect('/slider')->with('status' , 'Ajoutage Bien Faite !!');
  }

  public function updateSlider (Request $request){
    $request->validate([

    ]);
    
    if($request->filled('anime_id')){
         
      $slider = slider::find($request->id);
      $slider->anime_id = $request->anime_id;
      $slider->update();
      return redirect('/slider')->with('status' , 'La AnimeSlider est Bien Modifié !!');
    
    }else if ($request->filled('anime_film_id')){
      
      $slider = slider::find($request->id);
      $slider->anime_film_id = $request->anime_film_id;
      $slider->update();
      return redirect('/slider')->with('status' , 'La AnimeFilm Slider est Bien Modifié !!');
    }

  }

  public function deleteSlider (Request $request){
    $request->validate([
    ]);
    
    if($request->filled('anime_id')){
         
      $slider = slider::find($request->anime_id);
      $slider->anime_id = null;
      $slider->update();
      return redirect('/slider')->with('status' , 'La AnimeSlider est Bien Supprimé !!');
    
    }else if ($request->filled('anime_film_id')){
      
      $slider = slider::find($request->anime_film_id);
      $slider->anime_film_id = null;
      $slider->update();
      return redirect('/slider')->with('status' , 'La AnimeFilm Slider est Bien Supprimé !!');
    }

  }

}
