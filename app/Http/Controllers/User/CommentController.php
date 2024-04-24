<?php

namespace App\Http\Controllers\user;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\AnimeComment;
use App\Models\AnimeFilmComment;

class CommentController extends Controller
{
    public function addComment(Request $request){
        $request->validate([
            'id' => 'required',
            'content' => 'required',
        ]);
        if(session('user_id')){
            $comment = new AnimeComment();
            $comment->user_id = session('user_id');
            $comment->anime_id = $request->id;
            $comment->content = $request->content;

            $comment->save();
            
            return redirect('/animeDetails/' . $request->id)->with('status' , 'Comment has been added');
        }else{
            return redirect('/login')->with('status' , 'you should be logged in');
        }
    }

    public function deleteComment(Request $request){
         $request->validate([
            'id' => 'required',
         ]);

         $comment = AnimeComment::find($request->id);
         $comment->delete();

         return redirect('/animeDetails/' . $comment->anime_id)->with('status' , 'Comment has been deleted');
    }



    public function addFilmComment(Request $request){
        $request->validate([
            'id' => 'required',
            'content' => 'required',
        ]);
        
        if(session('user_id')){
            $comment = new AnimeFilmComment();
            $comment->user_id = session('user_id');
            $comment->anime_film_id = $request->id;
            $comment->content = $request->content;

            $comment->save();
            
            return redirect('/animeFilmDetails/' . $request->id)->with('status' , 'Comment has been added');
        }else{
            return redirect('/login')->with('status' , 'you should be logged in');
        }
    }

    public function deleteFilmComment(Request $request){
         $request->validate([
            'id' => 'required',
         ]);

         $comment = AnimeFilmComment::find($request->id);
         $comment->delete();

         return redirect('/animeFilmDetails/' . $comment->anime_film_id)->with('status' , 'Comment has been deleted');
    }
}
