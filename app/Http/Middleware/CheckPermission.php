<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckPermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     * @param  string  $permission  The required permission
     */
    public function handle(Request $request, Closure $next, string $permission): Response
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $user = Auth::user();

        // Super-admin or admin role bypasses all permission checks (backward compatibility)
        if ($user->hasRole('super-admin') || $user->hasRole('admin')) {
            return $next($request);
        }

        // Legacy admin role check for backward compatibility
        if ($user->role === 'admin') {
            return $next($request);
        }

        // Check if user has the specific permission
        if ($user->can($permission)) {
            return $next($request);
        }

        abort(403, "Unauthorized. You need the '{$permission}' permission to access this resource.");
    }
}
