<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\LoginHistory; // 👈 Import the LoginHistory model

class LoginHistoryController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Get login histories for the authenticated user
        $loginHistories = LoginHistory::where('user_id', $user->id)
            ->orderBy('login_at', 'desc')
            ->get();

        // Pass both user and loginHistories to the view
        return view('login-history.index', [
            'user' => $user,
            'loginHistories' => $loginHistories
        ]);
    }
}
