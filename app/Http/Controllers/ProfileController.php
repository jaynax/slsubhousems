<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function edit()
    {
        return view('layouts.users.profile', [
            'user' => Auth::user()
        ]);
    }

    public function update(Request $request)
    {
        $request->validate([
            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'name' => 'required|string|max:255',
        ]);

        $user = Auth::user();

        // Upload new profile image if provided
        if ($request->hasFile('profile_image')) {
            // Delete old image if exists
            if ($user->profile_image) {
                Storage::delete('public/profile_images/' . $user->profile_image);
            }

            $imageName = time() . '.' . $request->profile_image->extension();
            $request->profile_image->storeAs('public/profile_images', $imageName);
            $user->profile_image = $imageName;
        }

        // Update name
        $user->name = $request->name;
        $user->save();

        return back()->with('success', 'Profile updated successfully!');
    }
}
