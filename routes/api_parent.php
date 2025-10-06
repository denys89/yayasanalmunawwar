<?php

use Illuminate\Support\Facades\Route;

// Parent Portal API routes placeholder to satisfy bootstrap routing.
// Add real endpoints here as the parent frontend evolves.

Route::get('/health', function () {
    return response()->json([
        'status' => 'ok',
        'service' => 'Parent API',
        'version' => '1.0.0',
        'timestamp' => now()->toISOString(),
    ]);
});