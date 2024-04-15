<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Anime;
use App\Models\anime_categorie;
use App\Models\Categorie;
use App\Models\Source;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;

class AnimeController extends Controller
{
    public function displayAnime(){
        $animes = Anime::select('animes.*', 'sources.id as source_id', 'sources.nom')
        ->join('sources', 'animes.source_id', '=', 'sources.id')
        ->where('status', '=', 'showing')
        ->with('categories')
        ->get();
        $categories = Categorie::All();
        $sources = Source::All();

        return view('Back-office.Admin.AnimeTable' , compact('animes' , 'categories' , 'sources'));
    }

    public function addAnime(Request $request){
        $request->validate([
            'titre' => 'required',                      
            'description' => 'required',
            'posterLink' => 'required',
            'trailerLink' => 'required',
            'imbdLink' => 'required',
            'releaseYear' => 'required',
            // 'endYear' => 'required',
            'mangaka' => 'required',
            'studio' => 'required',
            'source_id' => 'required'
        ]);

        // dd($request->file('posterLink'));
        if ($request->hasFile('posterLink')) {
        $path = $request->file('posterLink')->store('postersAnime ', 's3');
        }
        
        $categories = [] ;
        
        if(is_array($request->categories)){
            
            foreach($request->categories as $categorie){
                $categories[]= $categorie;
            }
        }

        $animes = new Anime();
        // $animes->fill($request->all());    

        $animes->titre = $request->titre;
        $animes->description = $request->description;
        $animes->posterLink = Storage::disk('s3')->url($path);
        $animes->trailerLink = $request->trailerLink;
        $animes->imbdLink = $request->imbdLink;
        $animes->releaseYear = $request->releaseYear;
        $animes->endYear = $request->endYear;
        $animes->mangaka = $request->mangaka;
        $animes->studio = $request->studio;
        $animes->source_id = $request->source_id;
        $animes->save();

        // $lastId = Anime::latest('id')->first;
        $lastId = $animes->id ;

        if (count($categories) > 0) {
            foreach($categories as $categorie ){
                $anime_categorie = new anime_categorie();
                $anime_categorie->anime_id = $lastId;
                $anime_categorie->categorie_id = $categorie;

                $anime_categorie->save();
            }
        }

        return redirect('/anime')->with('status' , 'Lajoutage est Bien Faite!!');
    }   

    public function updateAnime(Request $request){
        $request->validate([
            'titre' => 'required',
            'description' => 'required',
            // 'posterLink' => 'required',
            'traillerLink' => 'required',
            'imbdLink' => 'required',
            'releaseYear' => 'required',
            // 'endYear' => 'required',
            'mangaka' => 'required',
            'studio' => 'required',
            'source_id' => 'required'
        ]);
        if ($request->hasFile('posterLink')) {
        $path = $request->file('posterLink')->store('posters ', 's3');
        }

        $anime = Anime::find($request->id);
        $anime->titre = $request->titre;
        $anime->description = $request->description;
        if ($request->hasFile('posterLink')) {
        $anime->posterLink = Storage::disk('s3')->url($path);
        }
        $anime->trailerLink = $request->traillerLink;
        $anime->imbdLink = $request->imbdLink;
        $anime->releaseYear = $request->releaseYear;
        $anime->endYear = $request->endYear;
        $anime->mangaka = $request->mangaka;
        $anime->studio = $request->studio;
        $anime->source_id = $request->source_id;
        if($request->status == 's'){
            $anime->status = 'showing';
        }else{
            $anime->status = 'hidden';
        }
        
        $anime->update();
        $anime_id = $request->id;

        $oldCategories = anime_categorie::where('anime_id' , $anime_id)->delete();

        // foreach($oldCategories as $oldCategorie){
        //     $oldCategorie->delete();
        // }

        $categories = [] ;
        
        if(is_array($request->categories)){
            
            foreach($request->categories as $categorie){
                $categories[]= $categorie;
            }
        }

        if (count($categories) > 0) {
            foreach($categories as $categorie ){
                $anime_categorie = new anime_categorie();
                $anime_categorie->anime_id = $request->id;
                $anime_categorie->categorie_id = $categorie;

                $anime_categorie->save();
            }
        }

        return redirect('/anime')->with('status' , 'La Modification Est Bien Faite !!');

    }

    public function hiddenAnime(Request $request){
        $request->validate([
            'id' => 'required',
        ]);

        // dd($request->id);
        $animes = Anime::find($request->id);
        $animes->status = 'hidden';
        $animes->update();  

        return redirect('/anime')->with('status' , 'LAnime Est Bien caché!!');

    }
}
