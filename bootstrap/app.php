<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Support\Facades\Route;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
        then: function () {
            Route::middleware('web')
                ->group(base_path('routes/cms.php'));
            
            Route::middleware('api')
                ->prefix('api/parent')
                ->group(base_path('routes/api_parent.php'));
        },
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->alias([
            'admin' => \App\Http\Middleware\AdminMiddleware::class,
            'editor' => \App\Http\Middleware\EditorMiddleware::class,
            'parent.access' => \App\Http\Middleware\ParentAccess::class,
            'permission' => \App\Http\Middleware\CheckPermission::class,
            'role' => \Spatie\Permission\Middleware\RoleMiddleware::class,
            'role_or_permission' => \Spatie\Permission\Middleware\RoleOrPermissionMiddleware::class,
        ]);
        
        // Redirect authenticated users to CMS dashboard
        $middleware->redirectGuestsTo('/login');
        $middleware->redirectUsersTo('/cms/dashboard');
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
