<?php

use App\Http\Controllers\Api\V1\Auth\EmailVerificationController;
use App\Http\Controllers\Api\V1\Auth\ForgotPasswordController;
use App\Http\Controllers\Api\V1\Auth\LoginController;
use App\Http\Controllers\Api\V1\Auth\RegisterController;
use App\Http\Controllers\Api\V1\Auth\ProfileController;
use App\Http\Controllers\Api\V1\Auth\ResetPasswordController;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function () {
    Route::prefix('auth')->group(function () {
        Route::post('register', RegisterController::class);
        Route::post('login', LoginController::class);
        Route::post('forgot-password', ForgotPasswordController::class); // ask frontend team to use this route
        Route::post('reset-password', ResetPasswordController::class);

        Route::middleware('auth:api')->group(function () {
            Route::get('me', [ProfileController::class, 'show']);
            Route::post('logout', [ProfileController::class, 'logout']);
            Route::post('email/verification-notification', [EmailVerificationController::class, 'sendVerificationEmail']);
            Route::get('verify-email',[EmailVerificationController::class, 'verify']);
        });
    });
});
