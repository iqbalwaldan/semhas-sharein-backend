<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function index()
    {
        return view('client.user.profile.index', [
            'title' => 'Profile',
            'active' => ''
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'email' => 'required|email',
            'phone_number' => 'required|string',
            'password' => 'required|string',
        ]);

        // Check if old password is correct
        if (!Hash::check($request->password, auth()->user()->password)) {
            return response()->json([
                'message' => 'Password is incorrect',
            ], 400);
        }

        $data = [
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'phone_number' => $request->phone_number,
        ];
        // If new password is provided, update it
        if ($request->filled('new_password')) {
            $data['password'] = Hash::make($request->new_password);
        }

        $user = User::find($id);
        $user->update($data);

        return response()->json([
            'message' => 'Profile updated successfully',
        ], 200);
    }
}
