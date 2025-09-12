<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ParentAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();
        
        // Check if user is authenticated
        if (!$user) {
            return response()->json([
                'message' => 'Unauthenticated'
            ], 401);
        }
        
        // Check if user has parent role
        if ($user->role !== 'parent') {
            return response()->json([
                'message' => 'Access denied. Parent access required.'
            ], 403);
        }
        
        // Check if parent account is active
        if (!$user->is_active) {
            return response()->json([
                'message' => 'Account is inactive. Please contact school administration.'
            ], 403);
        }
        
        return $next($request);
    }
}