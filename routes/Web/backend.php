<?php

use App\Http\Controllers\Web\Backend\CMS\HomePage\CaseStudyController;
use App\Http\Controllers\Web\Backend\CMS\HomePage\HomePageHeroSectionController;
use App\Http\Controllers\Web\Backend\CMS\HomePage\HomePageVideoBannerSectionController;
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

// CMS
Route::prefix('cms')->name('cms.')->group(function () {
    // Home Page
    Route::prefix('home-page')->name('home-page.')->group(function () {
        // Hero Section
        Route::controller(HomePageHeroSectionController::class)->prefix('hero-section')->name('hero-section.')->group(function () {
            Route::get('/', 'index')->name('index');
            Route::patch('/', 'update')->name('update');
        });

        // Video Banner Section
        Route::controller(HomePageVideoBannerSectionController::class)->prefix('video-banner')->name('video-banner.')->group(function () {
            Route::get('/', 'index')->name('index');
            Route::patch('/', 'update')->name('update');
        });

        // Case Studies Section
        Route::controller(CaseStudyController::class)->prefix('case-studies')->name('case-studies.')->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/create', 'create')->name('create');
            Route::post('/store', 'store')->name('store');
            Route::get('/edit/{id}', 'edit')->name('edit');
            Route::patch('/update/{id}', 'update')->name('update');
            Route::get('/status/{id}', 'status')->name('status');
            Route::delete('/destroy/{id}', 'destroy')->name('destroy');
        });
    });
});
