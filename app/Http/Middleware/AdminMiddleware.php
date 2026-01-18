<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     * 
     * Allow access for users with admin or super-admin role,
     * OR users with the legacy 'admin' role field (for backward compatibility).
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $user = Auth::user();

        // Check new Spatie roles first
        if ($user->hasRole(['super-admin', 'admin'])) {
            return $next($request);
        }

        // Fallback to legacy role field for backward compatibility
        if ($user->role === 'admin') {
            return $next($request);
        }

        abort(403, 'Unauthorized access. Admin privileges required.');
    }
}
