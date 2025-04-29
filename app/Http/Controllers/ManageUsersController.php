<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ManageUsersController extends Controller
{
    // Show all users
    public function index()
    {
        $users = User::all(); // You can use pagination if the list is long
        return view('admin.manage-users.index', compact('users'));
    }

    // Show the edit form for a user
    public function edit(User $user)
    {
        return view('admin.manage-users.edit', compact('user'));
    }

    // Update the user data
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        return redirect()->route('manage.users')->with('success', 'User updated successfully!');
    }

    // Delete a user
    public function destroy(User $user)
    {
        // Make sure not to delete the admin account or current logged-in user
        if ($user->id !== Auth::id()) {
            $user->delete();
            return redirect()->route('manage.users')->with('success', 'User deleted successfully!');
        }

        return redirect()->route('manage.users')->with('error', 'You cannot delete your own account!');
    }
}
