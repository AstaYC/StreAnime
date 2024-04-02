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
    $sliders = Slider::select('sliders.*', 'animes.titre as aTitre', 'animes.poster as aPoster', 'anime_films.titre', 'anime_films.poster')
    ->join('animes', 'sliders.media_id', '=', 'animes.id')
    ->join('anime_films', 'sliders.media_id', '=', 'anime_films.id')
    ->get();

    $animes = Anime::select('animes.id as anime_id' , 'animes.titre as anime_titre')->get();
    $films = Anime_film::select('anime_films.id as film_id' , 'anime_films.titre as film_titre')->get();

    $otakus = $animes->merge($films);
    
    return view('Back-office.Admin.SliderTable' , compact('sliders' , 'otakus'));
  }

  public function addSlider (Request $request){
    $request->validate([
        'media_id' => 'required',
        'type' => 'required',
    ]);

    $slider = new Slider();
    $slider->media_id = $request->media_id;
    $slider->type = $request->type;
    $slider->save();

    return redirect('/slider')->with('status' , 'Ajoutage Bien Faite !!');
  }

  public function updateSlider (Request $request){
    $request->validate([
        'media_id' => 'required',
        'type' => 'required',
    ]);

    $slider = slider::find($request->media_id);
    $slider->media_id = $request->media_id;
    $slider->type = $request->type;
    $slider->update();

    return redirect('/slider')->with('status' , 'La Modidication est  Bien Faite !!');


  }

  public function deleteSlider (Request $request){
    $request->validate([
        'media_id' => 'required',
    ]);
    $slider = slider::find($request->media_id);
    $slider->delete();

    return redirect('/slider')->with('status' , 'La Suppression est Bien Faite !!');

  }

}
