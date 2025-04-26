<?php

namespace App\Providers;

use App\Models\Admin;
use App\Services\Auth\AdminAuthService;
use App\Services\Auth\AdminAuthServiceInterface;
use App\Services\Auth\AuthService;
use App\Services\Auth\AuthServiceInterface;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind( AuthServiceInterface::class, AuthService::class);
        $this->app->bind( AdminAuthServiceInterface::class, AdminAuthService::class);
    }

     public function boot(): void
    {
        // Gate to check if the current user is Super Admin
        Gate::define('isSuperAdmin', function ($admin) {
            return $admin instanceof Admin && $admin->hasRole('super-admin');
        });

        // Gate to check if the current user is Admin (any admin, including super-admin)
        Gate::define('isAdmin', function ($admin) {
            return $admin instanceof Admin && ($admin->hasRole('admin') || $admin->hasRole('super-admin'));
        });

        // Dynamic Permission Gate
        Gate::define('permission', function ($userOrAdmin, $permission) {
            return $userOrAdmin->hasPermissionTo($permission);
        });
    }
}
