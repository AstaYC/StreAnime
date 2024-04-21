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
        $users = User::select('users.*' , 'roles.nom')
                       ->join('roles' , 'users.role_id' , '=' , 'roles.id')
                       ->get();
        $roles = Role::all();

        return view('Back-office.SuperAdmin.UserTable', compact('users' , 'roles'));
      } 


    public function updateUser(Request $request){
        $request->validate([
            'id' => 'required',
            'role' => 'required',
        ]);

        $user = User::find($request->id);
        $user->role_id = $request->role;
        $user->update();

        if($user->id == session('user_id')){
            session(['user_role' => $user->role_id]);
        } 

        return redirect('/user')->with('status' , 'The User Role has been updated');
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
