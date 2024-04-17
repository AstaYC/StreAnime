<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Anime;
use Illuminate\Http\Request;

class ContentDetailController extends Controller
{
    public function displayAnimeDetails($id){
        $anime = Anime::select('animes.*' , 'sources.nom as source_nom')
                 ->join('sources' , 'animes.source_id' , '=' , 'sources.id')
                 ->with('categories')
                 ->where('animes.id' , $id)
                 ->first();
        
        return view('Front-office.AnimeDetails' , compact('anime'));
    }
}
