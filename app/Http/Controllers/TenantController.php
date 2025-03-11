<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tenant;
use App\Models\BoardingHouse;
use Illuminate\Support\Facades\Auth;

class TenantController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'boarding_house_id' => 'required|exists:boarding_houses,id',
        ]);

        Tenant::create([
            'user_id' => Auth::id(),
            'boarding_house_id' => $request->boarding_house_id,
            'status' => 'pending', // Status can be 'pending' until approved
        ]);

        return back()->with('success', 'Registration request sent successfully.');
    }
}
