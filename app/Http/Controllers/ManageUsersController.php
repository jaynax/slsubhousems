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
        $users = User::all(); // You can paginate if needed
        return view('admin.manage-users.index', compact('users'));
    }

    // Show the form to create a new user
    public function create()
    {
        return view('admin.manage-users.create');
    }

    // Store new user
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
            'role_id' => 'required|integer',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role_id' => $request->role_id,
        ]);

        return redirect()->route('manage.users')->with('success', 'User created successfully!');
    }

    // Show a single user's details (Read)
    public function show(User $user)
    {
        return view('admin.manage-users.show', compact('user'));
    }

    // Show the edit form
    public function edit(User $user)
    {
        return view('admin.manage-users.edit', compact('user'));
    }

    // Update user data
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
        if ($user->id !== Auth::id()) {
            $user->delete();
            return redirect()->route('manage.users')->with('success', 'User deleted successfully!');
        }

        return redirect()->route('manage.users')->with('error', 'You cannot delete your own account!');
    }
}
