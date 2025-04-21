<?php

use App\Http\Controllers\Web\V1\Auth\SocialiteController;
use App\Http\Controllers\Web\V1\Backend\DashboardController;
use App\Http\Controllers\Web\V1\Frontend\HomeController;
use Illuminate\Support\Facades\Route;

//! Route for Admin Dashboard
Route::get('/', [HomeController::class, 'index'])->name('index');
Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('dashboard');

// This route is for finding the token for login with google.
Route::controller(SocialiteController::class)->group(function () {
    Route::get('/login/google', 'GoogleRedirect');
    Route::get('/login/google/callback', 'GoogleCallback');
});
