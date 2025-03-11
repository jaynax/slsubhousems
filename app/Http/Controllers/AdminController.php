<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BoardingHouse;

class AdminController extends Controller
{
    /**
     * Show all boarding houses with tenants and payments.
     */
    public function showBoardingHouse()
    {
        // Fetch all boarding houses with tenants and their payments
        $boardingHouses = BoardingHouse::with(['tenants.user',])->get();

        return view('admin.boardinghouse', compact('boardingHouses'));
    }
    public function index()
{
    $boardingHouses = BoardingHouse::with('tenants.user')->get();
    return view('admin.boardinghouses', compact('boardingHouses'));
}

}

class UserController extends Controller
{
    /**
     * Show the user dashboard.
     */
    public function index()
    {
        return view('user.dashboard'); // Create user/dashboard.blade.php view
    }

}
