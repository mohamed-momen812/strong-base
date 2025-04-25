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
            Route::middleware('api')
                ->name('admin.')
                ->group(base_path('routes/admin_api.php'));
        },
    )
    ->withMiddleware(function (Middleware $middleware) {

        $middleware->web(append: [
            // Add your custom middleware here
        ]);

        $middleware->api(prepend: [
            // Add your custom middleware here
        ]);

        $middleware->alias([
            // Add your custom middleware here
        ]);

    })
    ->withExceptions(function (Exceptions $exceptions) {
        // Add your custom exception handling here
    })->create();
