<?php

use App\Http\Controllers\Api\V1\Admin\Auth\LoginController;
use App\Http\Controllers\Api\V1\Admin\Auth\ProfileController;
use App\Http\Controllers\Api\V1\Admin\RoleAndPermission\PermissionController;
use App\Http\Controllers\Api\V1\Admin\RoleAndPermission\RoleController;
use Illuminate\Support\Facades\Route;

Route::prefix('api/v1/admin')->group(function () {
    Route::prefix('auth')->group(function () {
        Route::post('login', LoginController::class);

        Route::middleware(['auth:admin', 'can:isSuperAdmin'])->group(function () {
            Route::get('me', [ProfileController::class, 'show']);
            Route::post('logout', [ProfileController::class, 'logout']);
        });
    });

    // in controller i use semple logic so no need to use repo or service
    Route::middleware(['auth:admin', 'can:isSuperAdmin'])->group(function () {
        Route::get('roles', [RoleController::class, 'index']);
        Route::post('roles', [RoleController::class, 'store']);
        Route::get('roles/{role}', [RoleController::class, 'show']);
        Route::put('roles/{role}', [RoleController::class, 'update']);
        Route::put('roles/{role}/sync-permissions', [RoleController::class, 'syncPermissions']);
        Route::delete('roles/{role}', [RoleController::class, 'destroy']);

        Route::get('permissions', [PermissionController::class, 'index']);
        Route::post('permissions', [PermissionController::class, 'store']);
        Route::get('permissions/{permission}', [PermissionController::class, 'show']);
        Route::put('permissions/{permission}', [PermissionController::class, 'update']);
        Route::delete('permissions/{permission}', [PermissionController::class, 'destroy']);

    });
});
