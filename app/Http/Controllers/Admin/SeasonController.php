<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Anime;
use App\Models\Season;
use Illuminate\Support\Facades\Storage;

class SeasonController extends Controller
{
    public function displaySeason(){
        $seasons = Season::select('seasons.*', 'animes.titre as anime_titre' , 'animes.id as anime_id')
        ->join('animes', 'seasons.anime_id', '=', 'animes.id')
        ->where('seasons.status', '=', 'showing')
        ->get();    
       
        $animes = Anime::with('categories')->get();

        return view('Back-office.Admin.SeasonTable' , compact('seasons', 'animes'));
    }

    public function addSeason(Request $request){
        $request->validate([
            'titre' => 'required',
            'description' => 'required',
            'releaseYear' => 'required',
            // 'posterLink' => 'required',
            'imbdLink' => 'required',
            'trailerLink' => 'required',
            'seasonNumber' => 'required',
            'anime_id' => 'required',
        ]);

        if ($request->hasFile('posterLink')) {
            $pathPoster = $request->file('posterLink')->store('postersSeason ', 's3');
        }

        $seasons = new Season();
        // $seasons->fill($request->all());    

        $seasons->titre = $request->titre;
        $seasons->description = $request->description;
        $seasons->releaseYear = $request->releaseYear;
        $seasons->endYear = $request->endYear;
        if ($request->hasFile('posterLink')) {
        $seasons->posterLink = Storage::disk('s3')->url($pathPoster);
        }
        $seasons->trailerLink = $request->trailerLink;
        $seasons->imbdLink = $request->imbdLink;
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
            // 'posterLink' => 'required',
            'imbdLink' => 'required',
            'trailerLink' => 'required',
            'seasonNumber' => 'required',
            'anime_id' => 'required',
        ]);

        if ($request->hasFile('posterLink')) {
            $pathPoster = $request->file('posterLink')->store('postersSeason ', 's3');
        }

        $seasons = Season::find($request->id);
        // $seasons->fill($request->all());    

        $seasons->titre = $request->titre;
        $seasons->description = $request->description;
        $seasons->releaseYear = $request->releaseYear;

        if($request->filled('endYear')){
        $seasons->endYear = $request->endYear;
        }

        if ($request->hasFile('posterLink')) {
        $seasons->posterLink = Storage::disk('s3')->url($pathPoster);
        }
        $seasons->trailerLink = $request->trailerLink;
        $seasons->imbdLink = $request->imbdLink;
        $seasons->seasonNumber = $request->seasonNumber;
        
        if($request->filled('anime_id')){
            $seasons->anime_id = $request->anime_id;
        }

        $seasons->update();
        return redirect('/season')->with('status' , 'La Modidication est  Bien Faite !!');
    }

    public function hiddenSeason(Request $request){
        $request->validate([
            'id' => 'required',
        ]);

        // dd($request->id);
        $season = Season::find($request->id);
        $season->status = 'hidden';
        $season->update();  

        return redirect('/season')->with('status' , 'Season Est Bien caché!!');

    }
}
