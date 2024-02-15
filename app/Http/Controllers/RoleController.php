<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\Route;
use App\Models\Permission;
use Illuminate\Http\Request;

class RoleController extends Controller
{
      public function displayRole(){
        $roles = Role::all();
        $routes = Route::all();
        return view('role',compact('roles','routes'));
      }

      public function addRole(Request $request){
          $request->validate([
            'nom' => 'required|string|max:255',
          ]);

          $ids = [];
          foreach ($request->input('id') as $route_id) {
            $ids[] = $route_id;
          }

          $role = new Role();
          $permission = new Permission();

          $role->nom = $request->nom;
          $lasteId = Role::latest()->value('id');
           foreach($ids as $id){
            $permission->role_id = $lasteId;
            $permission->route_id = $id;
           }

      }

      public function updateRole(Request $request){
        $request->validate([
            'nom' => 'required|string|max:255'
        ]);

        $ids = [];
        


      }
}