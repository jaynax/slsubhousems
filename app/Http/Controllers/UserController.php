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
        // Get the authenticated user
        $user = Auth::user();

        // Find tenant application for this user, if any
        $tenantApplication = Tenant::where('user_id', $user->id)->first();

        // Get tenant status or default to 'none'
        $tenantStatus = $tenantApplication ? strtolower($tenantApplication->status) : 'none';

        // Get all boarding houses available
        $boardingHouses = BoardingHouse::all();

        // Pass data to the dashboard view
        return view('users.dashboard', [
            'tenantStatus' => $tenantStatus,
            'tenant' => $tenantApplication,
            'boardingHouses' => $boardingHouses,
        ]);
    }
}
