<?php

use App\Http\Controllers\Api\CMS\AboutPageController;
use App\Http\Controllers\Api\CMS\HeaderAndFooterController;
use App\Http\Controllers\Api\CMS\HomePageController;
use App\Http\Controllers\Api\CMS\PricingPageController;
use Illuminate\Support\Facades\Route;

Route::controller(HomePageController::class)->prefix('page/home')->group(function () {
    Route::get('/', 'index');
    Route::get('/faq/list', 'FAQList');
});

Route::get('/header-footer', HeaderAndFooterController::class);

Route::get('/page/about', [AboutPageController::class, 'index']);

Route::get('/page/pricing', PricingPageController::class);
