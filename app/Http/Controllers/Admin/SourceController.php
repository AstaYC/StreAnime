<?php


namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\SourceModel;

class SourceController extends Controller
{
    public function displaySource (){
        $sources = SourceModel::all();
        return view('Admin.SourceTable' , compact('sources'));
    }

    public function addSource(Request $request){
       
       $request->validate([
           'nom' => 'required',
       ]);

       $source = new SourceModel();
       $source->nom = $request->nom;
       $source->save();

       return redirect('/source')->with('status' , 'Ajoutage Bien Faite !!');
    }

    public function updateSource(Request $request){
       
        
        $request->validate([
            'nom' => 'required',
        ]);

        $source = SourceModel::find($request->id);
        $source->nom = $request->nom;
        $source->update();

        return redirect('/source')->with('status' , 'La Modification Est Bien Faite !!');
    }

    public function deleteSource(Request $request){
        $request->validate([
            'id' => 'required',
        ]);
        $source = SourceModel::find($request->id);
       $source->delete();

       return redirect('/source')->with('status' , 'La suppression est bien faite');
    }
}
