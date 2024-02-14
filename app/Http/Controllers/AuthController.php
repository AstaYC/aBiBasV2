<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register_page(){
        return view('Auth.register');
    }

    public function login_page(){
        return view('Auth.login');
    }

    public function register(Request $request){
        $request->validate([
            'nom' => 'required|string|max:255',
            'email' => 'required|email|unique:users|max:255',
            'password' => 'required|string|min:8|confirmed',
        ]);
        $defaultImages = 'public\assets';
        $user = new User();
        $user->nom = $request->input('nom');
        $user->email = $request->input('email');
        $user->password = bcrypt($request->input('password'));
        $user->images = $defaultImages;
        $user->role_id = '2';
        $user->save();

        if($user){
            
            return redirect('/categorie')->with('status', 'lajoutage est bien faite');
        }else{
            return redirect('/produit')->with('status', 'lajoutage est bien faite');
        }

    }
    
    public function login(Request $request){

        $request->validate([
            'email' => 'required|email|max:255',
            'password' => 'required|string|min:6',
        ]);

        
        $user = User::where('email', $request->email)->first();

        if(!$user || !Hash::check($request->password , $user->password)){
                return back()->with('error','l/Email Ou Le Mot De Passe est incorrect');
        }
    
        return redirect('/categorie');

    }


}
