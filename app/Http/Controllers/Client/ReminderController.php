<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ReminderController extends Controller
{
    public function index()
    {
        return view('client.user.reminder.index', [
            'title' => 'Reminder',
            'active' => 'reminder'
        ]);
    }
}
