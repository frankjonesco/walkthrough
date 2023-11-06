<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// SiteController routes
Route::controller(SiteController::class)->group(function () {
    Route::get('/', 'showHome');
    Route::get('/about', 'showAbout');
    Route::get('/posts', 'showPosts');
    Route::get('/contact', 'showContact');
});


// UserController routes
Route::controller(UserController::class)->group(function () {
    Route::get('/login', 'showLoginForm');
    Route::get('/signup', 'showRegistrationForm');
});
