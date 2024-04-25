<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Registered;
use App\Http\Requests\RegisterRequest;
use App\Http\Resources\UserResource;
use App\Models\User;

class RegisterController extends Controller
{
    public function register(RegisterRequest $request)
    {
        $request->validated($request->all());

        $registrationData = $request->all();
        $registrationData['password'] = bcrypt($registrationData['password']);

        $user = User::create($registrationData);
        $authentication['token'] =  $user->createToken('auth_tokens')->plainTextToken;

        event(new Registered($user)); //Sending Verification Email

        return response([
            'message' => 'Register Success, Please Verify Your Email First',
            'user' => [new UserResource($user)],
            'authentication' => $authentication,
        ], 200);
    }
}
