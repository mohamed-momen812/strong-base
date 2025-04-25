<?php

namespace App\Providers;

use App\Services\Auth\AdminAuthService;
use App\Services\Auth\AdminAuthServiceInterface;
use App\Services\Auth\AuthService;
use App\Services\Auth\AuthServiceInterface;
use Illuminate\Support\ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind( AuthServiceInterface::class, AuthService::class);
        $this->app->bind( AdminAuthServiceInterface::class, AdminAuthService::class);
    }
}
