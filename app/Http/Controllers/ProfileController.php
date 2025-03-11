<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function edit()
    {
        return view('layouts.users.profile');
    }

    // In your ProfileController
public function update(Request $request)
{
    $request->validate([
        'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        'name' => 'required|string|max:255',
        'phone' => 'nullable|string',
        'address' => 'nullable|string',
        'bio' => 'nullable|string',
    ]);

    $user = Auth::user();
    
    if ($request->hasFile('profile_image')) {
        $imageName = time() . '.' . $request->profile_image->extension();
        $request->profile_image->storeAs('public/profile_images', $imageName);
        $user->profile_image = $imageName;
    }

    $user->name = $request->name;
    $user->save();

    // Update other fields in the related profile if using a separate profile table
    $user->profile()->update([
        'phone' => $request->phone,
        'address' => $request->address,
        'bio' => $request->bio,
    ]);

    return back()->with('success', 'Profile updated successfully!');
}


  

}