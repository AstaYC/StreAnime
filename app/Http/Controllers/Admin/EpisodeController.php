<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Anime;
use App\Models\Episode;
use App\Models\Season;

class EpisodeController extends Controller
{
    public function displayEpisode(){
        $episodes = Episode::select('episodes.*' , 'seasons.titre as season_titre' , 'animes.titre as anime_titre')
        ->join('seasons' , 'episodes.season_id' , '=' , 'seasons.id')
        ->join('animes', 'seasons.anime_id', '=', 'animes.id')
        ->get();    
       
        $seasons = Season::select('seasons.*' , 'animes.titre as anime_titre')
        ->join ('animes' , 'seasons.anime_id' , '=' , 'animes.id')
        ->get();

        return view('Back-office.Admin.EpisodeTable' , compact('episodes', 'seasons'));
    }

    public function addEpisode(Request $request){
        $request->validate([
            'titre' => 'required',
            'releaseYear' => 'required',
            'mediaLink' => 'required',
            'posterLink' => 'required',
            'imbdLink' => 'required',
            'duration' => 'required',
            'episodeNumber' => 'required',
            'season_id' => 'required',
        ]);

        $episodes = new Episode();
        // $episodes->fill($request->all());    

        $episodes->titre = $request->titre;
        $episodes->description = $request->description;
        $episodes->releaseYear = $request->releaseYear;
        $episodes->posterLink = $request->posterLink;
        $episodes->mediaLink = $request->mediaLink;
        $episodes->imbdLink = $request->imbdLink;
        $episodes->duration = $request->duration;
        $episodes->episodeNumber = $request->episodeNumber;
        $episodes->season_id = $request->season_id;
        
        $episodes->save();
        return redirect('/episode')->with('status' , 'LAjoutage est Bien Faite !!');
    }

    public function updateEpisode(Request $request){
        $request->validate([
            'titre' => 'required',
            'releaseYear' => 'required',
            'mediaLink' => 'required',
            'posterLink' => 'required',
            'imbdLink' => 'required',
            'duration' => 'required',
            'episodeNumber' => 'required',
            'season_id' => 'required',
        ]);

        $episodes = Episode::find($request->id);
        // $episodes->fill($request->all());    

        $episodes->titre = $request->titre;
        $episodes->description = $request->description;
        $episodes->releaseYear = $request->releaseYear;
        $episodes->posterLink = $request->posterLink;
        $episodes->mediaLink = $request->mediaLink;
        $episodes->imbdLink = $request->imbdLink;
        $episodes->duration = $request->duration;
        $episodes->episodeNumber = $request->episodeNumber;
        $episodes->season_id = $request->season_id;

        $episodes->update();
        return redirect('/episode')->with('status' , 'La Modidication est  Bien Faite !!');
    }

    public function deleteEpisode(Request $request){
        $request->validate([
            'id' => 'required',
        ]);

        $episodes = Episode::find($request->id);
        $episodes->delete();
    }
}
