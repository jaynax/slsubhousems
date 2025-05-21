<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    /**
     * Show the edit profile page.
     */
    public function edit()
    {
        return view('layouts.users.profile', [
            'user' => Auth::user()
        ]);
    }

    /**
     * Handle the profile update.
     */
    public function update(Request $request)
    {
        $request->validate([
            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
        ]);

        $user = Auth::user();

        // Handle profile image upload
        if ($request->hasFile('profile_image')) {
            // Delete old image if it exists
            if ($user->profile_image) {
                Storage::delete('public/profile_images/' . $user->profile_image);
            }

            // Store new image
            $imageName = time() . '.' . $request->file('profile_image')->getClientOriginalExtension();
            $request->file('profile_image')->storeAs('public/profile_images', $imageName);
            $user->profile_image = $imageName;
        }

        // Update other fields
        $user->name = $request->name;
        $user->phone = $request->phone;
        $user->address = $request->address;
        $user->save();

        return back()->with('success', 'Profile updated successfully!');
    }
}
