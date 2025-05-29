<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BoardingHouse;
use App\Models\User;
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
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048', // image validation
        ]);

        // Prevent multiple boarding houses for same user (optional)
        if (BoardingHouse::where('user_id', $user->id)->exists()) {
            return back()->with('error', 'You already registered a boarding house.');
        }

        // Handle image upload
        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('boarding_house_images', 'public');
        }

        // Create boarding house
        BoardingHouse::create([
            'user_id' => $user->id,
            'name' => $request->name,
            'location' => $request->location,
            'contact_number' => $request->contact_number,
            'description' => $request->description,
            'image' => $imagePath,
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

        if (!$boardinghouse) {
            return view('boardinghouse.dashboard', ['info' => 'You do not have a registered boarding house yet.']);
        }

        $tenants = $boardinghouse->tenants()->with('user')->get();

        return view('boardinghouse.dashboard', compact('boardinghouse', 'tenants'));
    }

    /**
     * Show the form to create a new boarding house for admin.
     */
    public function createForAdmin(Request $request)
    {
        $userId = $request->query('user_id');
        return view('admin.boarding-house.create', compact('userId'));
    }

    /**
     * Show create boarding house form for a specific user (admin).
     */
    public function createForUser($userId)
    {
        $user = User::findOrFail($userId);
        return view('admin.manage-users.boardinghouse.create', compact('user'));
    }

  public function storeForUser(Request $request, $userId)
{
    $user = User::findOrFail($userId);

    $request->validate([
        'name' => 'required|string|max:255',
        'location' => 'required|string|max:500',
        'contact_number' => 'required|string|max:15',
        'description' => 'nullable|string|max:1000',
        'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048', // Add image validation here
    ]);

    if (BoardingHouse::where('user_id', $user->id)->exists()) {
        return back()->with('error', 'This user already owns a boarding house.');
    }

    // Handle image upload
    $imagePath = null;
    if ($request->hasFile('image')) {
        $imagePath = $request->file('image')->store('boarding_house_images', 'public');
    }

    BoardingHouse::create([
        'user_id' => $user->id,
        'name' => $request->name,
        'location' => $request->location,
        'contact_number' => $request->contact_number,
        'description' => $request->description,
        'image' => $imagePath,  // Save image path here
    ]);

    return redirect()->route('manage.users')->with('success', 'Boarding house created for user.');
}


    public function showBoardingHouse()
    {
        $boardingHouses = BoardingHouse::with('user')->get();
        return view('admin.boardinghouse.index', compact('boardingHouses'));
    }
    public function edit()
{
    // Get the currently logged-in user's boarding house
    $boardingHouse = auth()->user()->boardingHouse;

    // Check if boarding house exists for the user
    if (!$boardingHouse) {
        return redirect()->route('boardinghouse.dashboard')
            ->with('error', 'No boarding house found to edit.');
    }

    // Return the edit view with boarding house data
    return view('boardinghouse.edit', compact('boardingHouse'));
}
public function update(Request $request)
{
    $boardingHouse = auth()->user()->boardingHouse;

    if (!$boardingHouse) {
        return redirect()->route('boardinghouse.dashboard')
            ->with('error', 'No boarding house found to update.');
    }

    // Validate inputs including image
    $request->validate([
        'name' => 'required|string|max:255',
        'location' => 'required|string|max:255',
        'contact_number' => 'required|string|max:20',
        'description' => 'nullable|string',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // max 2MB
    ]);

    // If there is a new image, handle upload
    if ($request->hasFile('image')) {
        $image = $request->file('image');

        // Generate unique file name
        $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();

        // Move the image to public storage folder (e.g., storage/app/public/boardinghouses)
        $image->storeAs('public/boardinghouses', $imageName);

        // Delete old image if exists
        if ($boardingHouse->image) {
            \Storage::delete('public/boardinghouses/' . $boardingHouse->image);
        }

        // Save new image filename to DB
        $boardingHouse->image = $imageName;
    }

    // Update other fields
    $boardingHouse->name = $request->name;
    $boardingHouse->location = $request->location;
    $boardingHouse->contact_number = $request->contact_number;
    $boardingHouse->description = $request->description;

    $boardingHouse->save();

    return redirect()->route('boardinghouse.dashboard')->with('success', 'Boarding house updated successfully!');
}

}
