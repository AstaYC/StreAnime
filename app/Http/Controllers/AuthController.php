<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function displayLogin(){
         return view('Auth.login');
    }
    
    
    public function displayRegister(){
         return view('Auth.register');
    }
}
