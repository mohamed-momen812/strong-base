<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    public const HOME = '/home';

    public function boot()
    {
        $this->configureRateLimiting();

        $this->routes(function () {
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
        });
    }

    protected function configureRateLimiting()
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
        });

        RateLimiter::for('login', function (Request $request) {
            return Limit::perMinute(5)->by($request->ip());
        });
    }
}