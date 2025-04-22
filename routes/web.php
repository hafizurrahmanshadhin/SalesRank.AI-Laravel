<?php

use App\Http\Controllers\Web\V1\Backend\DashboardController;
use App\Http\Controllers\Web\V1\Frontend\HomeController;
use Illuminate\Support\Facades\Route;

// This route is for login with email and password.
Route::controller(HomeController::class)->middleware('guest')->group(function () {
    Route::get('/', 'create')->name('login');
    Route::post('/', 'store');

    // This route is for finding the token for login with google.
    Route::get('/login/google', 'GoogleRedirect');
    Route::get('/login/google/callback', 'GoogleCallback');
});

// This route is for logout.
Route::post('logout', [HomeController::class, 'destroy'])->middleware('auth')->name('logout');

// Here all the routes for the admin panel and all routes are protected by auth middleware. Only admin can access these routes.
Route::prefix('admin')->middleware(['auth', 'verified'])->group(function () {
    // Route for Admin Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});
