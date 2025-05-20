<?php

use App\Http\Controllers\Api\CMS\HomePageController;
use Illuminate\Support\Facades\Route;

Route::controller(HomePageController::class)->prefix('page/home')->group(function () {
    Route::get('/', 'index');
    Route::get('/faq/list', 'FAQList');
});
