<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\FacebookAccount;
use App\Http\Requests\LoginRequest;
use App\Http\Resources\UserResource;
use Laravel\Socialite\Facades\Socialite;

class LoginController extends Controller
{
    public function index(Request $request)
    {
        $this->validate($request, [
            'input' => 'required'
        ]);

        $user = User::where('first_name', $request->input)
            ->orWhere('last_name', $request->input)
            ->orWhere('phone_number', $request->input)
            ->orWhere('email', $request->input)
            ->orWhere('google_id', $request->input)
            ->first();

        if ($user) {
            return response([
                'message' => 'Successfully got user data by -',
                'user' => $user,
            ]);
        } else {
            return response([
                'message' => 'User not found for the given -',
                'user' => null,
            ], 404);
        }
    }

    // public function index(Request $request)
    // {
    //     $this->validate($request, [
    //         'input' => 'required'
    //     ]);

    //     $inputType = null;

    //     $fields = ['first_name', 'last_name', 'phone_number', 'email', 'google_id'];

    //     $user = User::where(function ($query) use ($request, $fields) {
    //         foreach ($fields as $field) {
    //             $query->orWhere($field, $request->input);
    //         }
    //     })->first();

    //     if ($user) {
    //         // Set nilai $inputType berdasarkan jenis input yang berhasil ditemukan
    //         foreach ($fields as $field) {
    //             if (!empty($user->{$field}) && $user->{$field} === $request->input) {
    //                 $inputType = $field;
    //                 break;
    //             }
    //         }

    //         return response([
    //             'message' => $user ? 'Successfully got user data by ' . $inputType : 'User not found for the given ' . $request->input,
    //             'user' => UserResource::make($user),
    //         ]);
    //     } else {
    //         return response([
    //             'message' => 'User not found for the given data',
    //             'user' => null,
    //         ], 404);
    //     }
    // }

    public function login(LoginRequest $loginRequest)
    {
        $loginRequest->validated();

        $credentials = $loginRequest->only('email', 'password');

        try {
            $user = User::where('email', $loginRequest->email)->firstOrFail();
        } catch (\Exception $e) {
            return response([
                'message' => 'We couldn\'t find the email that you entered'
            ], 401);
        }

        if (!Auth::attempt($credentials)) {
            return response([
                'message' => 'We couldn\'t find an account that matches what you entered'
            ], 401);
        }

        $authenticatedUser = Auth::user();

        if ($authenticatedUser->email_verified_at === null) {
            return response([
                'message' => 'Email is not verified, Please check your mail, junk, spam, etc.'
            ], 401);
        }

        $token = $user->createToken('User Authentication Token')->plainTextToken; //generate token

        return response([
            'message' => 'Authenticated',
            'user' => UserResource::make($authenticatedUser),
            'token_type' => 'Bearer',
            'access_token' => $token
        ]);
    }


    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return response([
            'success' => true,
            'message' => 'Logged Out Successfully'
        ], 200);
    }
}
