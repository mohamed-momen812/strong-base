<?php

use App\Http\Middleware\Api\TransformResponse;
use App\Http\Middleware\Api\VersionHeader;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Routing\Route;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
        then: function () {
            Route::prefix('api/v1')
            ->middleware(['api', 'api.version:v1'])
            ->namespace($this->namespace)
            ->group(base_path('routes/api_v1.php'));

            Route::prefix('api/v2')
                ->middleware(['api', 'api.version:v2'])
                ->namespace($this->namespace)
                ->group(base_path('routes/api_v2.php'));

            Route::middleware('web')
                ->namespace($this->namespace)
                ->group(base_path('routes/web.php'));

            Route::prefix('admin')
                ->middleware(['web', 'auth', 'admin'])
                ->namespace($this->namespace.'\Admin')
                ->group(base_path('routes/admin.php'));

            Route::middleware('web')
                ->namespace($this->namespace.'\Auth')
                ->group(base_path('routes/auth.php'));
        },
    )
    ->withMiddleware(function (Middleware $middleware) {
       
        $middleware->web(append: [
            //
        ]);
     
        $middleware->api(prepend: [
            TransformResponse::class,
            VersionHeader::class
        ]);

        $middleware->alias([
            'api.transform' => TransformResponse::class,
            'api.version' => VersionHeader::class,
        ]);
        
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
