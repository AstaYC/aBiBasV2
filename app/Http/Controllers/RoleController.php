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
          if (is_array($request->input('id'))) {
          foreach ($request->input('id') as $route_id) {
            $ids[] = $route_id;
          }
        }

          $role = new Role();

          $role->nom = $request->nom;
          $role->save();
          $lasteId = $role->id;
          
          if(count($ids) > 0){
              
            foreach($ids as $id){
              $permission = new Permission();
              $permission->role_id = $lasteId;
              $permission->route_id = $id;
              $permission->save();
               }
          }

           return redirect('/role')->with('status' , 'L"ajoutage est bien Faite');
      }

      public function updateRole(Request $request){
        $request->validate([
            'nom' => 'required|string|max:255',
            'role_id' => 'required',
        ]);

        $ids = [];
        if (is_array($request->input('id'))) {

        foreach ($request->input('id') as $route_id) {
            $ids[] = $route_id;
          }
        }

        $role = Role::find($request->role_id);
        $role->nom = $request->nom;
        $role->update();
        $permissions = Permission::where('role_id' , $request->role_id)->get();
        foreach($permissions as $permission){
            $permission->delete();
        }
       
        if(count($ids) > 0){
        foreach($ids as $id){
            $permission =new Permission();
            $permission->role_id = $request->role_id;
            $permission->route_id = $id;
            $permission->save();
        }
    }
         return redirect('/role')->with('status','La Modification est bien faite');
      }

    public function deleteRole(Request $request){
        $request->validate([
            'id' => 'required'
        ]);

        $role = Role::find($request->id);
        $role->delete();
        return redirect('/role')->with('status','La Supprission est bien faite');
    }
}