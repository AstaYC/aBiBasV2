<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produit;
use App\Models\Categorie;
use Illuminate\Support\Facades\DB;

class produitController extends Controller
{
   public function list_produit(){
       $produits = DB::select('select P.*, C.nom as categorie_nom from produits  P INNER JOIN categories C on P. categorie_id  = C.id');
       $categories = Categorie::all();
       return view('produit_list' , compact('produits','categories'));
    }

    // ...

    public function addProduit(Request $request)
    {
        $request->validate([
            'nom' => 'required',
            'description' => 'required',
            'prix' => 'required',
            'tags' => 'required',
            'categorie_id' => 'required',
        ]);
        $input = $request->all();
        
        if ($request->hasFile('images')) {
            $imageName = $request->file('images')->getClientOriginalName();
            $request->file('images')->move(public_path('assets'), $imageName);
            $input['images'] =  $imageName;
        }
    
        $produit = new Produit;
    
        $produit->nom = $input['nom'];
        $produit->description = $input['description'];
        $produit->prix = $input['prix'];
        $produit->images = $input['images'];
        $produit->tags = $input['tags'];
        $produit->categorie_id = $input['categorie_id'];
    
        $produit->save();
    
        return redirect('/produit')->with('status', 'Ajoute Bien Fait !!');
    }
    

    public function updateProduit(Request $request)
    {
       
        $request->validate([
            'nom' => 'required',
            'description' => 'required',
            'prix' => 'required',
            'tags' => 'required',
            'categorie_id' => 'required',
        ]);
        $input = $request->all();
        
        if ($request->hasFile('images')) {
            $imageName = $request->file('images')->getClientOriginalName();
            $request->file('images')->move(public_path('assets'), $imageName);
            $input['images'] =  $imageName;
        }
        
        $produit = Produit::find($input['id']);

        $produit->nom = $input['nom'];
        $produit->description = $input['description'];    
        $produit->prix = $input['prix'];
        $produit->images = $input['images'];
        $produit->tags = $input['tags'];
        $produit->categorie_id = $input['categorie_id'];

        $produit->update();

        return redirect('/produit')->with('status' , 'la modification est bien faite');
    
    }

    public function deleteProduit(Request $request){
        $request->validate([
            'id' => 'required',
        ]);
        $produit = Produit::find($request->id);
        $produit->delete();

        return redirect('/produit')->with('status' , 'La Suppression Est Bien Faite');
    }

}
