<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
  public function displayUser(){
    $users = DB::select('SELECT * ,users.id AS user_id , users.nom AS user_nom  , roles.nom AS role_nom FROM `users` INNER JOIN roles ON users.role_id = roles.id;');
    $roles = Role::all();
    foreach($users as $user){
      $user->password = str_repeat('*', strlen($user->password));

    }
    return view('user', compact('users','roles'));
  }

  public function addUser(Request $request){
    $request->validate([
        'nom' => 'required|string|max:50',
        'email' => 'required|email|max:100',
        'password' => 'required|string|min:6',
        'role_id' => 'required'
      ]);
      $passHash = bcrypt($request->password);
      $imagePath = 'public\assets';
      $user = new User();
      $user->fill($request->all());
      $user->images = $imagePath;
      $user->password = $passHash;
      $user->save();

      return redirect('/user')->with('status','l"ajoute est bien faite');
  }

  public function updateUser(Request $request){
    $request->validate([
        'nom' => 'required|string|max:50',
        'email' => 'required|email|max:50',
        'password' => 'required|string|min:6',
        'role_id' => 'required',
    ]);

    $user = User::find($request['id']);
    $user->nom = $request->nom;
    $user->email = $request->email;
    $user->password = bcrypt($request->password);
    $user->role_id = $request->role_id;
    $user->update();

    return redirect('/user')->with('status' , 'La Modification Du User Est Bien Faite');
  }

  public function deleteUser(Request $request){
    $request->validate([
        'id'=> 'required',
    ]);

    $user = User::find($request['id']);
    $user->delete();

    return redirect('/user')->with('status' , 'La Supprission Est Bien Faite');
  }
}
