<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BoardingHouse;
use App\Models\User; // <-- add this import
use Illuminate\Support\Facades\Auth;

class BoardingHouseController extends Controller
{
    /**
     * Show the form to create a new boarding house (for landlord).
     */
    public function create()
    {
        return view('boardinghouse.create'); // Blade form view for landlord
    }

    /**
     * Store a new boarding house.
     */
    public function store(Request $request)
    {
        $user = Auth::user();

        // Only users with role_id = 3 (landlords) can register
        if (!$user || $user->role_id != 3) {
            abort(403, 'Unauthorized access.');
        }

        // Validation
        $request->validate([
            'name' => 'required|string|max:255',
            'location' => 'required|string|max:500',
            'contact_number' => 'required|string|max:15',
            'description' => 'nullable|string|max:1000',
        ]);

        // Prevent multiple boarding houses for same user (optional)
        if (BoardingHouse::where('user_id', $user->id)->exists()) {
            return back()->with('error', 'You already registered a boarding house.');
        }

        // Create boarding house
        BoardingHouse::create([
            'user_id' => $user->id, // FK to users table
            'name' => $request->name,
            'location' => $request->location,
            'contact_number' => $request->contact_number,
            'description' => $request->description,
        ]);

        return redirect()->route('boardinghouse.dashboard')->with('success', 'Boarding house registered!');
    }

    /**
     * Show the boarding house dashboard.
     */
    public function index()
    {
        $user = Auth::user();

        // Get the boarding house owned by this user
        $boardinghouse = BoardingHouse::with('tenants')->where('user_id', $user->id)->first();

        // If no boarding house found
        if (!$boardinghouse) {
            return view('boardinghouse.dashboard', ['info' => 'You do not have a registered boarding house yet.']);
        }

        // Pass tenants and boardinghouse
        $tenants = $boardinghouse->tenants()->with('user')->get();

        return view('boardinghouse.dashboard', compact('boardinghouse', 'tenants'));
    }

    /**
     * Show the form to create a new boarding house for admin (admin version).
     */
    public function createForAdmin(Request $request)
    {
        $userId = $request->query('user_id');
        // Pass this to your view if you want to auto-fill or restrict owner selection
        return view('admin.boarding-house.create', compact('userId'));
    }

    /**
     * Optional: Show create boarding house form for a specific user (admin).
     */
    public function createForUser($userId)
    {
        $user = User::findOrFail($userId);
      return view('admin\manage-users\boardinghouse\create', compact('user'));


    }
}
