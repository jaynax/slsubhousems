<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Tenant;
use App\Models\BoardingHouse;


class TenantController extends Controller
{
    /**
     * Display a listing of tenant applications for the logged-in boarding house owner.
     */
    public function index()
    {
        $boardingHouse = Auth::user()->boardingHouse;

        if (!$boardingHouse) {
            return redirect()->route('boardinghouse.dashboard')->with('error', 'No boarding house found.');
        }

        // Get all tenants under the boarding house owned by logged-in user
        $tenants = $boardingHouse->tenants()->get();

        // Return the view with tenants data
        return view('boardinghouse.tenants.index', compact('tenants'));
    }

    /**
     * Submit a tenant application.
     */
    public function apply(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'boarding_house_id' => 'required|exists:boarding_houses,id',
            'contact_number' => 'required|string|max:20',
            'notes' => 'nullable|string|max:1000',
        ]);

        // Prevent duplicate applications
        if (Tenant::where('user_id', $user->id)->exists()) {
            return back()->with('error', 'You have already submitted an application.');
        }

        Tenant::create([
            'user_id' => $user->id,
            'boarding_house_id' => $request->boarding_house_id,
            'name' => $user->name,
            'contact_number' => $request->contact_number,
            'notes' => $request->notes,
            'status' => 'Pending',
        ]);

        return back()->with('success', 'Application submitted successfully!');
    }

    /**
     * Approve a tenant application and assign room number.
     */
    public function approve(Request $request, $id)
    {
        $tenant = Tenant::findOrFail($id);
        $owner = Auth::user();

        // Check if user owns a boarding house
        if (!$owner->boardingHouse) {
            return back()->with('error', 'You do not own a boarding house.');
        }

        // Check if tenant belongs to this boarding house
        if ($tenant->boarding_house_id !== $owner->boardingHouse->id) {
            return back()->with('error', 'Unauthorized to approve this tenant.');
        }

        $request->validate([
            'room_number' => 'required|string|max:10',
        ]);

        $tenant->status = 'Approved';
        $tenant->room_number = $request->room_number;
        $tenant->save();

        return back()->with('success', 'Tenant approved with room number ' . $tenant->room_number);
    }

    /**
     * Reject a tenant application.
     */
    public function reject($id)
    {
        $tenant = Tenant::findOrFail($id);
        $owner = Auth::user();

        if (!$owner->boardingHouse) {
            return back()->with('error', 'You do not own a boarding house.');
        }

        if ($tenant->boarding_house_id !== $owner->boardingHouse->id) {
            return back()->with('error', 'Unauthorized to reject this tenant.');
        }

        $tenant->status = 'Rejected';
        $tenant->save();

        return back()->with('info', 'Tenant rejected.');
    }

    /**
     * Show the form to edit tenant application (landlord only).
     */
    public function edit($id)
    {
        $tenant = Tenant::findOrFail($id);
        $owner = Auth::user();

        if ($tenant->boarding_house_id !== $owner->boardingHouse->id) {
            abort(403, 'Unauthorized access.');
        }

        return view('tenant.edit', compact('tenant'));
    }

    /**
     * Update tenant application (status, room, due amount, notes).
     */
    public function update(Request $request, $id)
    {
        $tenant = Tenant::findOrFail($id);
        $owner = Auth::user();

        if ($tenant->boarding_house_id !== $owner->boardingHouse->id) {
            abort(403, 'Unauthorized access.');
        }

        $request->validate([
            'status' => 'required|in:Pending,Approved,Rejected',
            'room_number' => 'nullable|string|max:10',
            'due_amount' => 'nullable|numeric|min:0',
            'notes' => 'nullable|string|max:1000',
        ]);

        $tenant->status = $request->status;
        $tenant->room_number = $request->room_number;
        $tenant->due_amount = $request->due_amount;
        $tenant->notes = $request->notes;
        $tenant->save();

        return redirect()->route('boardinghouse.tenants.index')->with('success', 'Tenant updated successfully.');
    }
     public function create()
{
    // Fetch all boarding houses (adjust the model & query as needed)
    $boardingHouses = BoardingHouse::all();

    // Pass it to the view
    return view('boardinghouse.tenants.create', compact('boardingHouses'));
}
public function show($id)
{
    $tenant = Tenant::findOrFail($id);
    return view('boardinghouse.tenants.show', compact('tenant'));
}



}

