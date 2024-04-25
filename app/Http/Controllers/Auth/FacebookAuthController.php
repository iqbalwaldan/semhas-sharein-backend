<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\FacebookAccount;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;

class FacebookAuthController extends Controller
{

    public function facebookRedirect()
    {
        return Socialite::driver('facebook')->redirect()->getTargetUrl();
    }

    public function facebookCallback(Request $request)
    {
        try {
            // Ambil data user dari Facebook secara stateless
            $facebookUser = Socialite::driver('facebook')->user();

            if (!$facebookUser) {
                throw new AuthorizationException('Credentials not valid');
            }

            //Simpan data pengguna Facebook ke dalam tabel facebook_accounts
            $user = FacebookAccount::firstOrCreate(
                ['fb_id' => $facebookUser->id],
                [
                    'user_id' => Auth::user()->id,
                    'name' => $facebookUser->name,
                    'email' => $facebookUser->email,
                    'avatar_url' => $facebookUser->avatar,
                ]
            );

            $access_token = $user->createToken('Facebook Authentication Token')->plainTextToken;

            return response([
                'message' => 'Succesfully Logged In Your Facebook Account',
                'facebook_user' => $facebookUser,
                'user' => $user,
                'access_token' => $access_token
            ], 200);
        } catch (\Throwable $e) {
            return response()->json([
                'message' => $e->getMessage() ?? "Error",
                'data' => null
            ], 400);
        }
    }
}
