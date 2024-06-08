<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ManageScheduleController extends Controller
{
    public function index()
    {
        return view('client.user.manage-schedule.index', [
            'title' => 'Manage Schedule',
            'active' => 'manage-schedule'
        ]);
    }
}
