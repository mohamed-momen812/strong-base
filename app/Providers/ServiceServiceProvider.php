<?php

namespace App\Providers;

use App\Services\Contracts\UserServiceInterface;
use App\Services\Internal\UserService;
use Illuminate\Support\ServiceProvider;

class ServiceServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(
            UserServiceInterface::class,
            UserService::class
        );
    }
}