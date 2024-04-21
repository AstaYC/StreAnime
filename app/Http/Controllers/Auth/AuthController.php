<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Tymon\JWTAuth\Facades\JWTFactory;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

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


    /**
     *
     * @return \Illuminate\Http\JsonResponse
     */

     public function register(Request $request){
        
        $validatedData = $request->validate([
            'name' => 'required|max:55',
            'email' => 'email|required|unique:users',
            'password' => 'required|confirmed|min:6'
        ]);

        $validatedData['password'] = Hash::make($validatedData['password']);
        $user = new User;
        $user->name = $validatedData['name'];
        $user->email = $validatedData['email'];
        $user->password = $validatedData['password'];
        $user->role_id = 3 ;
        $user->picture = "https://streanime.s3.amazonaws.com/postersCharacter%20/wGcVaEfd0iE01jwjise2DeXhDWpJGytWI4BOWQTK.jpg";
        $user->save();
        
        if(!$user){
            return redirect('/register')->with('error' , 'There is a problem , in your registration.');
        }

        $token = $this->respondWithToken($user->id);
       
        return redirect('/login')->with('status' , 'Registiration with Succes ! ')->cookie('jwt', $token, 60);
      }



     public function login(Request $request)
     {
        $validatedData = $request->validate([
            'email' => 'email|required',
            'password' => 'required|'
        ]);

        $user = User::where('email', $validatedData['email'])->first();
        
        if (!$user || !Hash::check($validatedData['password'], $user->password)) {
            return response()->json(['error' => 'Invalid credentials.'], 401);
        }

        $token = $this->respondWithToken($user->id);
        session(['user_id' => $user->id]);
        session(['user_name' => $user->name]);
        session(['user_role' => $user->role_id]);
        session(['picture' => $user->picture]);
        
        return redirect('/')->with('status' , 'Welcome ' . $user->name)->cookie('jwt', $token, 60);
    }

  
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
