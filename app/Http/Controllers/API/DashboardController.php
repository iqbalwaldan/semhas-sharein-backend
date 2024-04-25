<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\FacebookAccount;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function listAccounts(Request $request)
    {
        $accounts = FacebookAccount::where('user_id', Auth::user()->id)->get();

        if (!empty($accounts)) {
            return response([
                'message' => 'Succesfully Get All User\'s Facebook Account',
                'accounts' => $accounts
            ], 200);
        } else {
            return response([
                'message' => 'User\'s Does Not Have Any Facebook Account',
                'accounts' => null
            ], 200);
        }
    }
}
