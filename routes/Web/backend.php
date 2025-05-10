<?php

use App\Http\Controllers\Web\Backend\CollaborationController;
use App\Http\Controllers\Web\Backend\DashboardController;
use App\Http\Controllers\Web\Backend\SalesRankController;
use Illuminate\Support\Facades\Route;

// Route for Admin Dashboard
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::prefix('faq')->group(function () {
    // SalesRank.AI FAQ
    Route::controller(SalesRankController::class)->prefix('sales-rank')->name('sales-rank.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/show/{id}', 'show')->name('show');
        Route::get('/create', 'create')->name('create');
        Route::post('/store', 'store')->name('store');
        Route::get('/edit/{id}', 'edit')->name('edit');
        Route::put('/update/{id}', 'update')->name('update');
        Route::get('/status/{id}', 'status')->name('status');
        Route::delete('/destroy/{id}', 'destroy')->name('destroy');
    });

    // Collaboration FAQ
    Route::controller(CollaborationController::class)->prefix('collaboration')->name('collaboration.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/show/{id}', 'show')->name('show');
        Route::get('/create', 'create')->name('create');
        Route::post('/store', 'store')->name('store');
        Route::get('/edit/{id}', 'edit')->name('edit');
        Route::put('/update/{id}', 'update')->name('update');
        Route::get('/status/{id}', 'status')->name('status');
        Route::delete('/destroy/{id}', 'destroy')->name('destroy');
    });
});
