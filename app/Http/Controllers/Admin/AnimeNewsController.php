<?php


namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\AnimeNews;
use Illuminate\Support\Facades\Storage;

class AnimeNewsController extends Controller
{
    public function displayAnimeNews(){
        $animeNews = AnimeNews::select('anime_news.*' , 'animes.titre as anime_titre')
                                ->join('animes' , 'animes.id' ,'=' ,'anime_news.anime_id')
                                ->get();
        return view('Back-office.Admin.AnimeNewsTable' , compact('animeNews'));
    }

    public function addAnimeNews(Request $request){
       
       $request->validate([
           'titre' => 'required',
           'date' => 'required',
           'newsLink' => 'required',
       ]);

       if($request->hasFile('posterLink')){
        $path = $request->file('posterLink')->store('postersNews' , 's3');
       }

       $AnimeNews = new AnimeNews();
       $AnimeNews->titre = $request->titre;
      
       if($request->hasFile('posterLink')){
        $AnimeNews->posterLink = Storage::disk('s3')->url($path);
       }
       $AnimeNews->date = $request->date;
       $AnimeNews->newsLink = $request->newsLink;
       $AnimeNews->anime_id = $request->anime_id;

       $AnimeNews->save();

       return redirect('/animeNewsTable')->with('status' , 'Added successfully');
    }

    public function updateAnimeNews(Request $request){
       
        $request->validate([
            'titre' => 'required',
            'date' => 'required',
            'newsLink' => 'required',
        ]);

        if($request->hasFile('posterLink')){
            $path = $request->file('posterLink')->store('postersNews' , 's3');
        }

        $AnimeNews = AnimeNews::find($request->id);
        $AnimeNews->titre = $request->titre;
      
        if($request->hasFile('posterLink')){
         $AnimeNews->posterLink = Storage::disk('s3')->url($path);
        }
        $AnimeNews->date = $request->date;
        $AnimeNews->newsLink = $request->newsLink;
        $AnimeNews->anime_id = $request->anime_id;
        
        $AnimeNews->update();

        return redirect('/animeNewsTable')->with('status' , 'News table updated successfully');
    }

    public function deleteAnimeNews(Request $request){
        $request->validate([
            'id' => 'required',
        ]);
        $AnimeNews = AnimeNews::find($request->id);
        $AnimeNews->delete();

       return redirect('/animeNewsTable')->with('status' , 'Delete News with success');
    }
}
