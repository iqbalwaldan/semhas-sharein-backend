<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Http\Requests\SendingResetPasswordRequest;
use App\Http\Requests\ResetPasswordRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Http\RedirectResponse;

class ResetPasswordController extends Controller
{
    public function sendingResetPassword(SendingResetPasswordRequest $sendingResetPasswordRequest)
    {
        $sendingResetPasswordRequest->validated();

        $status = Password::sendResetLink(
            $sendingResetPasswordRequest->only('email')
        );

        return $status === Password::RESET_LINK_SENT
            ? back()->with(['status' => __($status)])
            : back()->withErrors(['email' => __($status)]);
    }

    public function getResetToken(string $token)
    {
        // Redirect to the frontend with the token
        // $redirectUrl = 'http::/localhost:3000';
        $redirectUrl = env('FRONTEND_URL');

        return redirect()->to($redirectUrl . '/reset-password/' . $token);
    }

    public function resetPassword(ResetPasswordRequest $resetPasswordRequest)
    {
        $resetPasswordRequest->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed|regex:/^.*(?=.{3,})(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[\d\x])(?=.*[!$#%]).*$/',
        ]);

        $status = Password::reset(
            $resetPasswordRequest->only('email', 'password', 'password_confirmation', 'token'),
            function (User $user, string $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->setRememberToken(Str::random(60));

                $user->save();

                event(new PasswordReset($user));
            }
        );

        return $status === Password::PASSWORD_RESET
            ? response()->json(['status' => __($status)], 422)
            : response()->json(['error' => __($status)], 422);
    }
}
