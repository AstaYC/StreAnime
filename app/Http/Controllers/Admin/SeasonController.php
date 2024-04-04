<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Anime;
use App\Models\Season;

class SeasonController extends Controller
{
    public function displaySeason(){
        $seasons = Season::select('seasons.*', 'animes.titre as animeTitre')
        ->join('animes', 'seasons.anime_id', '=', 'animes.id')
        ->get();    
       
        $animes = Anime::all();

        return view('Back-office.Admin.SeasonTable' , compact('seasons', 'animes'));
    }

    public function addSeason(Request $request){
        $request->validate([
            'titre' => 'required',
            'description' => 'required',
            'releaseYear' => 'required',
            'traillerLink' => 'required',
            'seasonNumber' => 'required',
            'anime_id' => 'required',
        ]);

        $seasons = new Season();
        // $seasons->fill($request->all());    

        $seasons->titre = $request->titre;
        $seasons->description = $request->description;
        $seasons->releaseYear = $request->releaseYear;
        $seasons->traillerLink = $request->traillerLink;
        $seasons->seasonNumber = $request->seasonNumber;
        $seasons->anime_id = $request->anime_id;
        
        $seasons->save();
        return redirect('/season')->with('status' , 'LAjoutage est Bien Faite !!');
    }

    public function updateSeason(Request $request){
        $request->validate([
            'id' => 'required',
            'titre' => 'required',
            'description' => 'required',
            'releaseYear' => 'required',
            'traillerLink' => 'required',
            'seasonNumber' => 'required',
            'anime_id' => 'required',
        ]);

        $seasons = Season::find($request->id);
        // $seasons->fill($request->all());    

        $seasons->titre = $request->titre;
        $seasons->description = $request->description;
        $seasons->releaseYear = $request->releaseYear;
        $seasons->traillerLink = $request->traillerLink;
        $seasons->seasonNumber = $request->seasonNumber;
        $seasons->anime_id = $request->anime_id;

        $seasons->update();
        return redirect('/season')->with('status' , 'La Modidication est  Bien Faite !!');
    }

    public function deleteSeason(Request $request){
        $request->validate([
            'id' => 'required',
        ]);

        $seasons = Season::find($request->id);
        $seasons->delete();
    }
}
