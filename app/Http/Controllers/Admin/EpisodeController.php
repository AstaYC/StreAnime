<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Anime;
use App\Models\Episode;
use App\Models\Season;
use Illuminate\Support\Facades\Storage;

class EpisodeController extends Controller
{
    public function displayEpisode(){
        $episodes = Episode::select('episodes.*' , 'seasons.titre as season_titre' , 'animes.titre as anime_titre')
        ->join('seasons' , 'episodes.season_id' , '=' , 'seasons.id')
        ->join('animes', 'seasons.anime_id', '=', 'animes.id')
        ->where('episodes.status' , '=' , 'showing')
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
            // 'posterLink' => 'required',
            'duration' => 'required',
            'episodeNumber' => 'required',
            'season_id' => 'required',
        ]);

        if ($request->hasFile('posterLink')) {
            $pathPoster = $request->file('posterLink')->store('postersEpisode ', 's3');
         }

         if ($request->hasFile('mediaLink')) {
            $pathMedia = $request->file('mediaLink')->store('mediasEpisode ', 's3');
         }

        $episodes = new Episode();
        // $episodes->fill($request->all());    

        $episodes->titre = $request->titre;
        $episodes->releaseYear = $request->releaseYear;
        if ($request->hasFile('posterLink')) {
          $episodes->posterLink = Storage::disk('s3')->url($pathPoster);
        }

        if ($request->hasFile('mediaLink')) {
            $episodes->mediaLink = Storage::disk('s3')->url($pathMedia);
        }
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
            // 'mediaLink' => 'required',
            // 'posterLink' => 'required',
            'duration' => 'required',
            'episodeNumber' => 'required',
            // 'season_id' => 'required',
        ]);

        if ($request->hasFile('posterLink')) {
            $pathPoster = $request->file('posterLink')->store('postersEpisode ', 's3');
         }

         if ($request->hasFile('mediaLink')) {
            $pathMedia = $request->file('mediaLink')->store('mediasEpisode ', 's3');
         }

        $episodes = Episode::find($request->id);
        // $episodes->fill($request->all());    

        $episodes->titre = $request->titre;
        $episodes->releaseYear = $request->releaseYear;
        if ($request->hasFile('posterLink')) {
          $episodes->posterLink = Storage::disk('s3')->url($pathPoster);
        }

        if ($request->hasFile('mediaLink')) {
            $episodes->mediaLink = Storage::disk('s3')->url($pathMedia);
        }
        $episodes->duration = $request->duration;
        $episodes->episodeNumber = $request->episodeNumber;
        
        if($request->filled('season_id')){
            $episodes->season_id = $request->season_id;
        }

        $episodes->update();
        return redirect('/episode')->with('status' , 'La Modidication est  Bien Faite !!');
    }

    public function hiddenEpisode(Request $request){
        $request->validate([
            'id' => 'required',
        ]);

        $episodes = Episode::find($request->id);
        $episodes->status = 'hidden';
        $episodes->update();

        return redirect('/episode')->with('status' , 'LEpisode est  Bien Caché !!');

    }
}
