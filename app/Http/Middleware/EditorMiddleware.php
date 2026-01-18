<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class EditorMiddleware
{
    /**
     * Handle an incoming request.
     * 
     * Allow access for users with editor, admin, or super-admin role,
     * OR users with the legacy 'admin' or 'editor' role field (for backward compatibility).
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
        if ($user->hasRole(['super-admin', 'admin', 'editor'])) {
            return $next($request);
        }

        // Fallback to legacy role field for backward compatibility
        if (in_array($user->role, ['admin', 'editor'])) {
            return $next($request);
        }

        abort(403, 'Unauthorized access. Editor privileges required.');
    }
}
