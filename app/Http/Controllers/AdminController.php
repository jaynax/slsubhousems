<?php

namespace App\Http\Controllers;
use App\Models\Role;  // add this at the top
use Illuminate\Http\Request;
use App\Models\BoardingHouse;
use App\Models\User;


class AdminController extends Controller
{
    /**
     * Show the admin dashboard with summary stats and boarding houses.
     */
    public function dashboard()
{
    $totalBoardingHouses = BoardingHouse::count();

    // Change this line to count only users with role_id = 2 (users)
    $totalUsers = User::where('role_id', 2)->count();

    $totalAdmins = User::where('role_id', 1)->count();

    $boardingHouses = BoardingHouse::with(['tenants.user'])->get();

    return view('admin.dashboard', compact('totalBoardingHouses', 'totalUsers', 'totalAdmins', 'boardingHouses'));
}



    /**
     * Show all users for admin management.
     */
    

public function manageUsers()
{
    // Eager load users for each role
    $roles = Role::with('users')->get();

    return view('admin.manage-users.index', compact('roles'));
}


    /**
     * Show form to create a new user.
     */
    public function createUser()
    {
        return view('admin.manage-users.create');
    }

    /**
     * Store a newly created user.
     */
    public function storeUser(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'role'     => 'required|string',
        ]);

        User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => bcrypt($request->password),
            'role'     => $request->role,
        ]);

        return redirect()->route('manage.users')->with('success', 'User created successfully.');
    }
}
