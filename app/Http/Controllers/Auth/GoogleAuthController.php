<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;

class GoogleAuthController extends Controller
{
    public function googleRedirect()
    {
        return Socialite::driver('google')->redirect()->getTargetUrl();
    }

    public function googleCallback(Request $request): JsonResponse
    {
        if ($request->has(['code', 'authuser', 'prompt'])) {
            try {
                $googleUser = Socialite::driver('google')->user();

                if (!$googleUser) {
                    throw new AuthorizationException('Credentials not valid');
                }

                DB::beginTransaction();

                $user = User::query()->firstOrCreate(
                    [
                        'email' => $googleUser->getEmail()
                    ],
                    [
                        'first_name' => $googleUser->getName(),
                        'google_id' => $googleUser->getId(),
                    ]
                );

                Auth::login($user);

                DB::commit();

                $google_token = $user->createToken('token', ['*'], now()->addDays(1))->plainTextToken;
                $access_token = $user->createToken('Google Authentication Token')->plainTextToken;

                return response()->json([
                    'message' => "Succesfully Authenticated by Google Sign In",
                    'user' => $user,
                    'expired_at' => $user->tokens->first()->expires_at,
                    'google_token' => $google_token,
                    'token_type' => 'Bearer',
                    'access_token' => $access_token
                ], 200);
            } catch (\Throwable $e) {
                DB::rollBack();
                return response()->json([
                    'message' => $e->getMessage() ?? "Error",
                    'data' => null
                ], 400);
            }
        }

        return response()->json([
            'message' => "Invalid params for google login",
            'data' => null
        ], 400);
    }
}
