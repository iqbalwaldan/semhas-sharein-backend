<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Auth\Events\Verified;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Models\User;

class EmailVerificationController extends Controller
{
    public function sendVerification(Request $request): RedirectResponse
    {
        $user = User::find($request->route('id'));

        if ($user->hasVerifiedEmail()) {
            return redirect(env('FRONTEND_URL') . '/email-verification/already-success');
        }

        if ($user->markEmailAsVerified()) {
            event(new Verified($user));
        }

        return redirect(env('FRONTEND_URL') . '/email-verification/success');
    }

    public function resendVerification(Request $request)
    {

        $request->user()->sendEmailVerificationNotification();

        return response([
            'message' => 'Verification link sent!'
        ], 200);
    }
}
