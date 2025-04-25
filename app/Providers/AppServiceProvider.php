<?php

namespace App\Providers;

use App\Actions\Admin\CreateUserAction;
use App\Actions\Admin\UpdateUserAction;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // use singleton not bind to prevent multiple instances of the same class specifically for actions because they are stateless
        $this->app->singleton(CreateUserAction::class);
        $this->app->singleton(UpdateUserAction::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
