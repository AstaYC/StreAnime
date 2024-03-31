<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Anime;
use App\Models\Character;

class CharacterController extends Controller
{
    public function displayCharacter (){
        $characters = Character::select('characters.*', 'animes.nom as anime_nom', 'anime_films.nom as anime_films_nom')
                      ->join('animes', 'characters.anime_id', '=', 'animes.id')
                      ->join('anime_films', 'characters.animeFilm_id', '=', 'anime_films.id')
                      ->get();
                      
        $animes = Anime::all();
        return view('Back-office.CharacterTable' , compact('characters'));
    }

    public function addCharacter(Request $request){
       
       $request->validate([
           'nom' => 'required',
           'glance' => 'required',
       ]);

       if ($request->hasFile('images')) {
        $imageName = $request->file('images')->getClientOriginalName();
        $request->file('images')->move(public_path('img'), $imageName);
        $data['images'] =  $imageName;
      }

       $character = new Character();
       $character->nom = $request->nom;
       $character->glance = $request->glance;
       $character->image = $data['images'];
       $character->anime_id = $request->anime_id;
       $character->animeFilm_id  = $request->animeFilm_id ;
       $character->save();

       return redirect('/character')->with('status' , 'Ajoutage Bien Faite !!');
    }

    public function updateCharacter(Request $request){
       
        
        $request->validate([
            'id' => 'required',
            'nom' => 'required'
        ]);

        if ($request->hasFile('images')) {
            $imageName = $request->file('images')->getClientOriginalName();
            $request->file('images')->move(public_path('img'), $imageName);
            $data['images'] =  $imageName;
          }

        $character = Character::find($request->id);
        $character->nom = $request->nom;
        $character->glance = $request->glance;
        $character->image = $data['images'];
        $character->anime_id = $request->anime_id;
        $character->animeFilm_id  = $request->animeFilm_id ;
        $character->update();

        return redirect('/character')->with('status' , 'La Modification Est Bien Faite !!');
    }

    public function deleteCharacter(Request $request){
        $request->validate([
            'id' => 'required',
        ]);
        $character = Character::find($request->id);
       $character->delete();

       return redirect('/character')->with('status' , 'La suppression est bien faite');
    }
}