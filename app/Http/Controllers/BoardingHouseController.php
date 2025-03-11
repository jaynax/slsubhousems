<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BoardingHouse;
use App\Models\Tenant;
use Illuminate\Support\Facades\Auth;

class BoardingHouseController extends Controller
{
    /**
     * Show the boarding house owner dashboard.
     */
    public function index()
    {
        // Get the logged-in user's boarding house
        $boardinghouse = BoardingHouse::where('owner_id', Auth::id())->first();

        // Ensure the boarding house exists
        if (!$boardinghouse) {
            return redirect()->route('home')->with('error', 'Boarding house not found.');
        }

        // Fetch tenants for the boarding house
        $tenants = Tenant::where('boarding_house_id', $boardinghouse->id)->get();

        return view('boardinghouse.dashboard', compact('boardinghouse', 'tenants'));
    }
}

