<?php

use App\Http\Controllers\Api\V1\Admin\Auth\LoginController;
use App\Http\Controllers\Api\V1\Admin\Auth\ProfileController;
use Illuminate\Support\Facades\Route;

Route::prefix('api/v1/admin')->group(function () {
    Route::prefix('auth')->group(function () {
        Route::post('login', LoginController::class);

        Route::middleware('auth:admin')->group(function () {
            Route::get('me', [ProfileController::class, 'show']);
            Route::post('logout', [ProfileController::class, 'logout']);
        });
    });
});
