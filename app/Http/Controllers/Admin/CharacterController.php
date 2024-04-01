<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Anime;
use App\Models\Anime_film;
use App\Models\Anime_film_character;
use App\Models\Character;

class CharacterController extends Controller
{
    public function displayCharacter (){
        $characters = Character::select('characters.*', 'animes.nom as anime_nom')
                      ->join('animes', 'characters.anime_id', '=', 'animes.id')
                      ->get();
        $characterWithFilms = Character::with('anime_films')->get();
        $animes = Anime::all();
        $animeFilms = Anime_film::all();
        return view('Back-office.Admin.CharacterTable' , compact('characters' , 'animes' , 'animeFilms'));
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
       $character->save();

       $films = [];
       if(is_array($request->input('films_id'))) {
        foreach($request->input('films_id') as $films_id) {
            $films[] = $films_id;
        }
       }
    //    $lastCharacter = Character::latest('id')->first();
       $lastCharacter = $character->id;

       if (count($films) > 0){
        foreach($films as $film) {
            $film_character = new Anime_film_character();
            $film_character->anime_film_id = $film ;
            $film_character->character_id = $lastCharacter ;
            $film_character->save();
        }
       }

       return redirect('/character')->with('status' , 'Ajoutage Bien Faite !!');
    }

    public function updateCharacter(Request $request){
       
        
        $request->validate([
            'nom' => 'required',
            'glance' => 'required',
        ]);

        if ($request->hasFile('images')) {
            $imageName = $request->file('images')->getClientOriginalName();
            $request->file('images')->move(public_path('img'), $imageName);
            $data['images'] =  $imageName;
          }

        $character = Character::find($request->id);
        $character->nom = $request->nom;
        $character->glance = $request->glance;
        if($request->hasFile('images')){
            $character->image = $data['images'];
        }
        $character->anime_id = $request->anime_id;
        $character->update();

        $film_characters = Anime_film_character::where('character_id', $request->id)->get();
        foreach($film_characters as $film_character){
            $film_character->delete();
        }

        $films = [];
        if(is_array($request->input('films_id'))) {
        foreach($request->input('films_id') as $films_id) {
            $films[] = $films_id;
        }
       }
    //    $lastCharacter = Character::latest('id')->first();
        // $lastCharacter = $character->id;


       if (count($films) > 0){
        foreach($films as $film) {
            $film_character = new Anime_film_character();
            $film_character->anime_film_id = $film ;
            $film_character->character_id = $request->id;
            $film_character->save();
        }
       }


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