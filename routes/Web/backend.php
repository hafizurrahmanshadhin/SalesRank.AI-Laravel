<?php

use App\Http\Controllers\Web\Backend\CMS\FAQ\CollaborationController;
use App\Http\Controllers\Web\Backend\CMS\FAQ\SalesRankController;
use App\Http\Controllers\Web\Backend\CMS\HomePage\BlogsPreviewController;
use App\Http\Controllers\Web\Backend\CMS\HomePage\FeatureBlockController;
use App\Http\Controllers\Web\Backend\CMS\HomePage\HomePageHeroSectionController;
use App\Http\Controllers\Web\Backend\CMS\HomePage\HomePageVideoBannerSectionController;
use App\Http\Controllers\Web\Backend\CMS\TestimonialController;
use App\Http\Controllers\Web\Backend\DashboardController;
use Illuminate\Support\Facades\Route;

// Route for Admin Dashboard
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

// CMS
Route::prefix('cms')->name('cms.')->group(function () {
    // Testimonials
    Route::controller(TestimonialController::class)->prefix('testimonials')->name('testimonials.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/show/{id}', 'show')->name('show');
        Route::get('/create', 'create')->name('create');
        Route::post('/store', 'store')->name('store');
        Route::get('/edit/{id}', 'edit')->name('edit');
        Route::patch('/update/{id}', 'update')->name('update');
        Route::get('/status/{id}', 'status')->name('status');
        Route::delete('/destroy/{id}', 'destroy')->name('destroy');
    });

    Route::prefix('faq')->name('faq.')->group(function () {
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
        Route::controller(FeatureBlockController::class)->prefix('feature-blocks')->name('feature-blocks.')->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/create', 'create')->name('create');
            Route::post('/store', 'store')->name('store');
            Route::get('/edit/{id}', 'edit')->name('edit');
            Route::patch('/update/{id}', 'update')->name('update');
            Route::get('/status/{id}', 'status')->name('status');
            Route::delete('/destroy/{id}', 'destroy')->name('destroy');
        });

        // Blogs Preview Section
        Route::controller(BlogsPreviewController::class)->prefix('blogs-preview')->name('blogs-preview.')->group(function () {
            Route::get('/', 'index')->name('index');
            Route::patch('/', 'updateBlogsPreview')->name('update.blogs.preview');
            Route::get('/blog/show/{id}', 'showBlog')->name('show.blog');
            Route::post('/blog/store', 'storeBlog')->name('store.blog');
            Route::put('/blog/update/{id}', 'updateBlog')->name('update.blog');
            Route::get('/blog/status/{id}', 'status')->name('status.blog');
            Route::delete('/blog/destroy/{id}', 'destroy')->name('destroy.blog');
        });
    });
});
