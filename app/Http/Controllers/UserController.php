<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Tenant;
use App\Models\BoardingHouse;

class UserController extends Controller
{
    /**
     * Show the user dashboard.
     */
    public function index()
    {
        $user = Auth::user();

        // Get tenant application for logged-in user
        $tenant = Tenant::where('user_id', $user->id)->first();

        // Normalize tenant status or default to 'none'
        $tenantStatus = $tenant ? strtolower(trim($tenant->status)) : 'none';

        // Get all boarding houses
        $boardingHouses = BoardingHouse::all();

        // Pass variables to the dashboard view
        return view('users.dashboard', compact('tenantStatus', 'tenant', 'boardingHouses'));
    }
}
