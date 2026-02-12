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
     * @param  \Closure(\Illuminate\Http\Request)  $next
     * @param  mixed ...$roles
     */
    public function handle(Request $request, Closure $next, ...$roles)
    {
        // Cek login
        if (!Auth::check()) {
            return redirect('/login');
        }

        // Cek role
        if (!in_array(Auth::user()->role, $roles)) {
            abort(403, 'Unauthorized'); // atau redirect ke halaman lain
        }

        return $next($request);
    }
}
