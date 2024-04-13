<?php

namespace App\Http\Controllers\SuperAdmin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function displayUser(Request $request){
        $users = DB::table('users')->join('roles','users.role_id','=','roles.id')
                 ->select('users.*','users.id as user_id' , 'users.nom as user_nom', 'roles.nom as role_nom');
                 
        $roles = Role::all();
        foreach($users as $user){
           $user->password = str_repeat('*', strlen($user->password));
        }
    
        return view('user', compact('users','roles'));
      } 

    public function deleteUser(Request $request){
        $request->validate([
            'id' => 'required',
        ]);
        $user = User::find($request->id);
        $user->delete();

       return redirect('/user/display')->with('status' , 'La suppression est bien faite');
    }
}
