<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Tenant;

class TenantController extends Controller
{
    /**
     * Submit a tenant application.
     */
    public function apply(Request $request)
    {
        $user = Auth::user();

        // Validate input - make sure boarding_house_id is legit
        $request->validate([
            'boarding_house_id' => 'required|exists:boarding_houses,id',
            'contact_number' => 'required|string|max:20',
            'notes' => 'nullable|string|max:1000',
        ]);

        // Check if the user already applied
        if (Tenant::where('user_id', $user->id)->exists()) {
            return back()->with('error', 'You have already submitted an application.');
        }

        // Store tenant application with boarding_house_id from the form
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

        if (!$owner->boardingHouse) {
            return back()->with('error', 'You do not own a boarding house.');
        }

        if ($tenant->boarding_house_id && $tenant->boarding_house_id !== $owner->boardingHouse->id) {
            return back()->with('error', 'Unauthorized to approve this tenant.');
        }

        // Validate room_number input
        $request->validate([
            'room_number' => 'required|string|max:10',
        ]);

        if (!$tenant->boarding_house_id) {
            $tenant->boarding_house_id = $owner->boardingHouse->id;
        }

        $tenant->status = 'Approved';
        $tenant->room_number = $request->room_number;  // assign room number here
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

        if ($tenant->boarding_house_id && $tenant->boarding_house_id !== $owner->boardingHouse->id) {
            return back()->with('error', 'Unauthorized to reject this tenant.');
        }

        if (!$tenant->boarding_house_id) {
            $tenant->boarding_house_id = $owner->boardingHouse->id;
        }

        $tenant->status = 'Rejected';
        $tenant->save();

        return back()->with('info', 'Tenant rejected.');
    }
}
