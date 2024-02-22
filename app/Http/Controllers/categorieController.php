<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categorie;

class categorieController extends Controller
{
    public function liste_categorie (){
        $categories = Categorie::paginate(10);
        return view('categorie_list' , compact('categories'));
    }

    public function addCategorie(Request $request){
       
       $request->validate([
           'nom' => 'required',
       ]);

       $categorie = new Categorie();
       $categorie->nom = $request->nom;
       $categorie->save();

       return redirect('/categorie')->with('status' , 'Ajoutage Bien Faite !!');
    }

    public function updateCategorie(Request $request){
       
        
        $request->validate([
            'nom' => 'required',
        ]);

        $categorie = Categorie::find($request->id);
        $categorie->nom = $request->nom;
        $categorie->update();

        return redirect('/categorie')->with('status' , 'La Modification Est Bien Faite !!');
    }

    public function deleteCategorie(Request $request){
        $request->validate([
            'id' => 'required',
        ]);
        $categorie = Categorie::find($request->id);
       $categorie->delete();

       return redirect('/categorie')->with('status' , 'La suppression est bien faite');
    }



}