<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  int  $role
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $role)
    {
        if (!Auth::check()) {
            return redirect('/login'); // Redirect to login if not authenticated
        }

        $user = Auth::user();

        // Check role by comparing the role_id
        if (($role == 'admin' && $user->role_id == 1) ||
            ($role == 'user' && $user->role_id == 2) ||
            ($role == 'boardinghouse' && $user->role_id == 3)) {
            return $next($request);
        }

        return redirect('/unauthorized'); // Redirect if unauthorized
    }
}
