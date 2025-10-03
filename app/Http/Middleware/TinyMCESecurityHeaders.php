<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TinyMCESecurityHeaders
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        // Only apply to CMS routes that use TinyMCE
        if ($request->is('cms/*')) {
            // Content Security Policy for TinyMCE
            $csp = [
                "default-src 'self'",
                "script-src 'self' 'unsafe-inline' 'unsafe-eval' https://cdn.tiny.cloud https://sp.tinymce.com",
                "style-src 'self' 'unsafe-inline' https://cdn.tiny.cloud",
                "img-src 'self' data: blob: https://cdn.tiny.cloud https://sp.tinymce.com",
                "font-src 'self' https://cdn.tiny.cloud",
                "connect-src 'self' https://cdn.tiny.cloud https://sp.tinymce.com",
                "frame-src 'self' https://cdn.tiny.cloud",
                "worker-src 'self' blob:",
                "child-src 'self' blob:",
            ];

            $response->headers->set('Content-Security-Policy', implode('; ', $csp));

            // Additional security headers
            $response->headers->set('X-Content-Type-Options', 'nosniff');
            $response->headers->set('X-Frame-Options', 'SAMEORIGIN');
            $response->headers->set('Referrer-Policy', 'strict-origin-when-cross-origin');
            
            // Feature Policy for TinyMCE
            $featurePolicy = [
                "camera 'none'",
                "microphone 'none'",
                "geolocation 'none'",
                "payment 'none'",
                "usb 'none'",
            ];
            
            $response->headers->set('Permissions-Policy', implode(', ', $featurePolicy));
        }

        return $response;
    }
}