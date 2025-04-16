<?php

use App\Http\Controllers\Api\V1\Auth\AuthController;
use App\Http\Controllers\Api\V1\Auth\PasswordResetController;
use App\Http\Controllers\Api\V1\Auth\SocialLoginController;
use Illuminate\Support\Facades\Route;

Route::prefix('/v1/auth')->name('api.auth.')->group(function () {
    // Guest routes - Accessible by unauthenticated users only
    Route::middleware('guest:api')->group(function () {
        // Authentication-related routes
        Route::controller(AuthController::class)->group(function () {
            Route::post('/register', 'register')->name('register');
            Route::post('/login', 'login')->name('login');
        });

        Route::controller(PasswordResetController::class)->group(function () {
            Route::post('/forgot-password', 'forgotPassword');
            Route::post('/reset-password', 'resetPassword');
        });

        Route::prefix('/social')->name('social.')->controller(SocialLoginController::class)->group(
            function () {
                Route::post('/login', 'socialLogin')->name('login');
            }
        );
    });

    // Authenticated routes - Accessible only by authenticated users
    Route::middleware('auth:api')->group(function () {
        // Authentication-related routes
        Route::controller(AuthController::class)->group(function () {
            Route::post('/logout', 'logout')->name('logout');
        });
    });
});
