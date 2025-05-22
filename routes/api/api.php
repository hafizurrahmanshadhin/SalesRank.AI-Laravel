<?php

use App\Http\Controllers\Api\ContentController;
use App\Http\Controllers\Api\NewsletterController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Support\Facades\Route;

// This route is for getting terms and conditions and privacy policy.
Route::get('contents', [ContentController::class, 'index'])->middleware(['throttle:10,1']);

// Define a POST route for storing newsletter data
Route::post('/newsletters/store', [NewsletterController::class, 'store']);

Route::controller(UserController::class)->middleware(['auth.jwt', 'throttle:10,1'])->prefix('user')->group(function () {
    Route::get('/profile', 'getAuthenticatedUser');
    Route::post('/update-profile', 'updateProfile');
    Route::post('/portfolio/project/upload', 'uploadPortfolioProject');
    Route::delete('/portfolio/project/delete/{id}', 'deletePortfolioProject');
    Route::patch('/update-password', 'updatePassword');
});
