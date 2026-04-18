<?php

namespace App\Http\Controllers\users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $userType = auth()->user()->user_type;  // Get the role of the authenticated user

        return view('dashboard', compact('userType'));  // Pass the role to the view
    }
}
