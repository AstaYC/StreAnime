<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Tymon\JWTAuth\Facades\JWTFactory;
use Illuminate\Http\Request;
use App\Models\User;

class AuthController extends Controller
{



    public function displayLogin(){
        return view('Auth/Login');
    }

    public function displayRegister(){
        return view('Auth/Register');
    }
      /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login']]);
    }

    /**
     *
     * @return \Illuminate\Http\JsonResponse
     */

     public function register(Request $request){
          $request->validate([
              'nom' => 'required|string|max:255',
              'email' => 'required|email|unique:users|max:255',
              'password' => 'required|min:6|confirmed',
          ]);
          $user = new User();
          $user->nom = $request->input('nom');
          $user->email = $request->input('email');
          $user->password = bcrypt($request->input('password'));
          $user->role_id = '2';
          $user->save();
  
          if($user){
              
              return redirect('/login')->with('status', 'lajoutage est bien faite');
          }else{
              return redirect('/login')->with('status', 'Une probleme dans la registration');
          }
      }



     public function login()
     {
        $validator = Validator::make(request()->all(), [
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|min:8|max:255'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
         
        $check = request(['email', 'password']);
      if (! $token = auth()->attempt($check)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        return $this->respondWithToken($token);
}

//     public function login(Request $request){

//         $request->validate([
//             'email' => 'required|email|max:255',
//             'password' => 'required|string|min:6',
//         ]);

        
//         $user = User::join('roles', 'users.role_id', '=', 'roles.id')
//             ->where('users.email', $request->email)
//             ->first(['users.*', 'roles.nom as user_role']); 
        
//         if(!$user || !Hash::check($request->password , $user->password)){
//                 return back()->with('error',"l' Email Ou Le Mot De Passe est incorrect");
//         }
//         session(['user_id' => $user->id]);
//         session(['user_role' => $user->user_role]);
//         session(['user_nom' => $user->nom]);
//         session(['role_id' => $user->role_id]);

    
//         return redirect('/home');

//     }
  
    /**
     * Log the user out (Invalidate the token).
     *

     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => JWTFactory::getTTL() * 60
        ]);
    }
 
 }
