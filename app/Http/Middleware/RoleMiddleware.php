<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Role;

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
    public function handle(Request $request, Closure $next, $role_access)
    {
        if (!Auth::check()) {
            return redirect('/login'); // Redirect to login if not authenticated
        }

        $user = Auth::user();
        $role = Role::where('id' ,$user->role_id)->first();
        // Check role by comparing the role_id
        if (strtolower($role->name) == strtolower($role_access)) {
            return $next($request);
        }

        return redirect('/unauthorized'); // Redirect if unauthorized
    }
}
