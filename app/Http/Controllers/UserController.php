<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BoardingHouse;

class UserController extends Controller
{
    /**
     * Show the user dashboard.
     */
    public function index()
    {
        // // Fetch all boarding houses
        // $boardinghouses = BoardingHouse::all();

        // Pass them to the dashboard view
        return view('users.dashboard');
    }
}
