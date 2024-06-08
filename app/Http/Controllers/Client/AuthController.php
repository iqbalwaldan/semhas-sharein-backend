<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

// use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function indexLogin()
    {
        return view('client.user.auth.login.index');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            if (auth()->user()->email_verified_at == null) {
                Auth::logout();
                return back()->with('loginError', 'Please verify your email first!');
            }
            // Regenerate the session
            $request->session()->regenerate();

            // Generate a session token
            $sessionToken = session()->getId();

            // Save the session token in a cookie
            setcookie('tokenlogin', $sessionToken, time() + (86400 * 30), "/"); // Cookie will expire in 30 days

            return redirect()->intended('/dashboard');
        }
        return back()->with('loginError', 'Login failed!');
    }

    public function indexRegister()
    {
        return view('client.user.auth.register.index');
    }

    public function register(RegisterRequest $request)
    {
        $request->validated($request->all());

        $registrationData = $request->all();
        $registrationData['password'] = bcrypt($registrationData['password']);

        $user = User::create($registrationData);
        $authentication['token'] =  $user->createToken('auth_tokens')->plainTextToken;

        Auth::logout();

        // event(new Registered($user)); //Sending Verification Email

        return view('client.user.auth.login.index');
    }

    public function indexForgotPassword()
    {
        return view('client.user.auth.resetPassword.index');
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
