<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\DashboardController;

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



// SITE CONTROLLER

// SiteController routes
Route::controller(SiteController::class)->group(function () {
    Route::get('/', 'showHome');
    Route::get('/about', 'showAbout');
    Route::get('/articles', 'showPosts');
    Route::get('/contact', 'showContact');
});



// ARTICLES CONTROLLER



// ArticleController routes (auth only)
Route::controller(ArticleController::class)->middleware('auth')->group(function () {
    Route::get('/articles/create', 'create');
    Route::post('/articles/store', 'store');
});

// ArticleController routes (all users)
Route::controller(ArticleController::class)->group(function () {
    Route::get('/articles', 'index');
    Route::get('/articles/{article}', 'show');
});




// USER CONTROLLER

// UserController routes (auth only)
Route::controller(UserController::class)->middleware('auth')->group(function(){
    Route::post('/logout', 'logout');
});

// UserController routes (guest only)
Route::controller(UserController::class)->middleware('guest')->group(function () {
    Route::get('/login', 'showLoginForm');
    Route::get('/signup', 'showRegistrationForm');
    Route::post('/users/store', 'store');
    Route::post('/users/authenticate', 'authenticate');
});




// DASHBORD CONTROLLER

// DashboardController (auth only)
Route::controller(DashboardController::class)->middleware('auth')->group(function(){
    Route::get('/dashboard', 'index');
});
