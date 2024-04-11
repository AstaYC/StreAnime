<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Anime;
use App\Models\anime_categorie;
use App\Models\Categorie;
use App\Models\Source;

class AnimeController extends Controller
{
    public function displayAnime(){
        $animes = Anime::select("*")->join('sources' ,  'animes.source_id' ,'=' , 'sources.id')->with('categories')->get();
        $categories = Categorie::All();
        $sources = Source::All();
        return view('Back-office.Admin.AnimeTable' , compact('animes' , 'categories' , 'sources'));
    }

    public function addAnime(Request $request){
        $request->validate([
            'titre' => 'required',
            'description' => 'required',
            'poster' => 'required',
            'traillerLink' => 'required',
            'imbdLink' => 'required',
            'releaseYear' => 'required',
            'endYear' => 'required',
            'mangaka' => 'required',
            'studio' => 'required',
            'source_id' => 'required'
        ]);

        $categories = [] ;
        
        if(is_array($request->categories)){
            
            foreach($request->categories as $categorie){
                $categories[]= $categorie;
            }
        }

        $animes = new Anime();
        // $animes->fill($request->all());    

        $animes->titre = $request->titre;
        $animes->traillerLink = $request->traillerLink;
        $animes->description = $request->description;
        $animes->poster = $request->poster;
        $animes->imbdLink = $request->imbdLink;
        $animes->releaseYear = $request->releaseYear;
        $animes->releaseYear = $request->releaseYear;
        $animes->mangaka = $request->mangaka;
        $animes->studio = $request->studio;
        //   SSS Configurations
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

        return redirect('/anime')->with('status' , 'LAjoutage est Bien Faite !!');
    }

    public function updateAnime(Request $request){
        $request->validate([
            'titre' => 'required',
            'traillerLink' => 'required',
            'description' => 'required',
            'poster' => 'required',
            'imbdLink' => 'required',
            'releaseYear' => 'required',
            'mangaka' => 'required',
            'studio' => 'required',
            'source_id' => 'required'
        ]);   

        $anime = Anime::find($request->id);
        $anime->titre = $request->titre;
        $anime->traillerLink = $request->traillerLink;
        $anime->description = $request->description;
        $anime->poster = $request->poster;
        $anime->imbdLink = $request->imbdLink;
        $anime->releaseYear = $request->releaseYear;
        $anime->releaseYear = $request->releaseYear;
        $anime->mangaka = $request->mangaka;
        $anime->studio = $request->studio;    
        
        $anime->update();

        $oldCategories = anime_categorie::where('anime_id' , $request->id)->get();

        foreach($oldCategories as $oldCategorie){
            $oldCategorie->delete();
        }

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

    public function deleteAnime(Request $request){
        $request->validate([
            'id' => 'required',
        ]);
        $animes = Anime::find($request->id);
        $animes->delete();
    }
}
