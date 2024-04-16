<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Anime;
use App\Models\Anime_film;
use App\Models\Anime_film_character;
use App\Models\Character;
use Illuminate\Support\Facades\Storage;

class CharacterController extends Controller
{
    public function displayCharacter (){
        $characters = Character::select('characters.*', 'animes.titre as anime_titre')
                      ->join('animes', 'characters.anime_id', '=', 'animes.id')
                      ->get();
        $characterWithFilms = Character::with('anime_films')->get();
        $animes = Anime::all();
        $animeFilms = Anime_film::select('anime_films.*' , 'animes.titre as anime_titre')
                     ->join('animes' , 'anime_films.anime_id', '=', 'animes.id')
                     ->get();
        return view('Back-office.Admin.CharacterTable' , compact('characters' , 'animes' , 'animeFilms' , 'characterWithFilms'));
    }

    public function addCharacter(Request $request){
       
       $request->validate([
           'nom' => 'required',
           'glance' => 'required',
           'picture' => 'required',
       ]);
      
       if ($request->hasFile('picture')) {
         $path = $request->file('picture')->store('postersCharacter ', 's3');
        }

       $character = new Character();
       $character->nom = $request->nom;
       $character->glance = $request->glance;

       if ($request->hasFile('picture')) {
        $character->picture = Storage::disk('s3')->url($path);
       }

       if ($request->filled('anime_id')) {
         $character->anime_id = $request->anime_id;
       }
       
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
        
        if ($request->hasFile('picture')) {
            $path = $request->file('picture')->store('postersCharacter ', 's3');
        }

        $character = Character::find($request->id);
        $character->nom = $request->nom;
        $character->glance = $request->glance;
 
        if ($request->hasFile('picture')) {
         $character->picture = Storage::disk('s3')->url($path);
        }
 
        if ($request->filled('anime_id')) {
          $character->anime_id = $request->anime_id;
        }

        $character->update();

        if($request->filled('films_id')){
            $film_characters = Anime_film_character::where('character_id', $request->id)->delete();
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