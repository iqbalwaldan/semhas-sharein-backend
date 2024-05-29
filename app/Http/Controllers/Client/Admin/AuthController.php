<?php

namespace App\Http\Controllers\Client\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function indexLogin()
    {
        return view('client.admin.auth.login.index');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            if (auth()->user()->email_verified_at == null && auth()->user()->is_admin == 'admin'){
                return back()->with('loginError', 'Please verify your email first!');
            }
            // Regenerate the session
            $request->session()->regenerate();

            // Generate a session token
            $sessionToken = session()->getId();

            // Save the session token in a cookie
            setcookie('tokenlogin', $sessionToken, time() + (86400 * 30), "/"); // Cookie will expire in 30 days

            return redirect()->intended('/admin/dashboard');
        }
        return back()->with('loginError', 'Login failed!');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        
        // Make invalidate the session
        $request->session()->invalidate();

        // Regenerate the session
        $request->session()->regenerateToken();

        // Delete the session token in a cookie 
        setcookie('tokenlogin', '', time() - 3600, "/");

        return redirect('/login');
    }
}
