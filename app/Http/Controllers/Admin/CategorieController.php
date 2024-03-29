<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\CategorieModel;


class CategorieController extends Controller
{
    public function displayCategorie (){
        $categories = CategorieModel::all();
        return view('Back-office.CategorieTable' , compact('categories'));
    }

    public function addCategorie(Request $request){
       
       $request->validate([
           'nom' => 'required',
       ]);

       $categorie = new CategorieModel();
       $categorie->nom = $request->nom;
       $categorie->save();

       return redirect('/categorie')->with('status' , 'Ajoutage Bien Faite !!');
    }

    public function updateCategorie(Request $request){
       
        
        $request->validate([
            'nom' => 'required',
        ]);

        $categorie = CategorieModel::find($request->id);
        $categorie->nom = $request->nom;
        $categorie->update();

        return redirect('/categorie/display')->with('status' , 'La Modification Est Bien Faite !!');
    }

    public function deleteCategorie(Request $request){
        $request->validate([
            'id' => 'required',
        ]);
        $categorie = CategorieModel::find($request->id);
       $categorie->delete();

       return redirect('/categorie/display')->with('status' , 'La suppression est bien faite');
    }
}
