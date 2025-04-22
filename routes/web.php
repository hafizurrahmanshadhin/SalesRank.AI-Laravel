<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\V1\Backend\FAQController;
use App\Http\Controllers\Web\V1\Frontend\HomeController;
use App\Http\Controllers\Web\V1\Backend\DashboardController;
use App\Http\Controllers\Web\Backend\Settings\ProfileController;
use App\Http\Controllers\Web\Backend\Settings\SystemSettingsController;

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

    //! Route for FAQ Page
    Route::controller(FAQController::class)->group(function () {
        Route::get('/faq', 'index')->name('faq.index');
        Route::get('/faq/show/{id}', 'show')->name('faq.show');
        Route::get('/faq/create', 'create')->name('faq.create');
        Route::post('/faq/store', 'store')->name('faq.store');
        Route::get('/faq/edit/{id}', 'edit')->name('faq.edit');
        Route::put('/faq/update/{id}', 'update')->name('faq.update');
        Route::get('/faq/status/{id}', 'status')->name('faq.status');
        Route::delete('/faq/destroy/{id}', 'destroy')->name('faq.destroy');
    });
});

//! Route for Profile Settings
Route::controller(ProfileController::class)->group(function () {
    Route::get('/profile', 'index')->name('profile.setting');
    Route::patch('/update-profile', 'UpdateProfile')->name('update.profile');
    Route::put('/update-profile-password', 'UpdatePassword')->name('update.Password');
    Route::post('/update-profile-picture', 'UpdateProfilePicture')->name('update.profile.picture');
    Route::post('/update-cover-photo', 'UpdateCoverPhoto')->name('update.cover.photo');
});

//! Route for System Settings
Route::controller(SystemSettingsController::class)->group(function () {
    Route::get('/system-setting', 'index')->name('system.index');
    Route::patch('/system-setting', 'update')->name('system.update');
});
