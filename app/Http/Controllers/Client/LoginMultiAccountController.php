<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoginMultiAccountController extends Controller
{
    public function index()
    {
        return view('client.user.login-multi-account.index', [
            'title' => 'Login Multi Account',
            'active' => 'login-multi-account'
        ]);
    }
}
