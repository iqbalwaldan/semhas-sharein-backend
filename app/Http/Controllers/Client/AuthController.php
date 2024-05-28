<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login(){
        return view('client.auth.login.index');
    }
    public function register(){
        return view('client.auth.register.index');
    }
    public function forgotpassword(){
        return view('client.auth.resetPassword.index');
    }
}
