<?php

use App\Http\Controllers\Web\V1\Auth\SocialiteController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// This route is for finding the token for login with google.
Route::controller(SocialiteController::class)->group(function () {
    Route::get('/login/google', 'GoogleRedirect');
    Route::get('/login/google/callback', 'GoogleCallback');
});
