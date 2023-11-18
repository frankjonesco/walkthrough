<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CategoryController;
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
    Route::get('/articles/{article}/edit', 'edit');
    Route::post('/articles/{article}/update', 'update');
    Route::get('/articles/{article}/image', 'editImage');
    Route::post('/articles/{article}/image/upload', 'uploadImage');
    Route::get('/articles/{article}/image/crop', 'cropImage');
    Route::post('/articles/{article}/image/render', 'renderImage');
    Route::get('/articles/{article}/confirm-delete', 'showConfirmDeleteForm');
    Route::post('/articles/destroy', 'destroy');
});

// ArticleController routes (all users)
Route::controller(ArticleController::class)->group(function () {
    Route::get('/articles', 'index');
    Route::get('/articles/{article}', 'show');
});




// USER CONTROLLER

// UserController routes (auth only)
Route::controller(UserController::class)->middleware('auth')->group(function(){
    Route::get('profile', 'showProfile');
    Route::get('profile/edit', 'editProfile');
    Route::post('profile/update', 'updateProfile');
    Route::get('profile/edit-password', 'editPassword');
    Route::post('/profile/update-password', 'updatePassword');
    Route::get('/profile/image', 'editImage');
    Route::post('/profile/image/upload', 'uploadImage');
    Route::get('/profile/image/crop', 'cropImage');
    Route::post('/profile/image/render', 'renderImage');
    Route::post('/logout', 'logout');
});

// UserController routes (guest only)
Route::controller(UserController::class)->middleware('guest')->group(function () {
    Route::get('/login', 'showLoginForm')->name('login');
    Route::get('/signup', 'showRegistrationForm');
    Route::post('/users/store', 'store');
    Route::post('/users/authenticate', 'authenticate');
});




// CATEGORY CONTROLLER

// CategoryController (auth only)
Route::controller(CategoryController::class)->middleware('auth')->group(function () {
    Route::get('/categories/create', 'create');
    Route::post('/categories/store', 'store');
    Route::get('/categories/{category}/edit', 'edit');
    Route::post('/categories/{category}/update', 'update');
    Route::get('/categories/{category}/image', 'editImage');
    Route::post('/categories/{category}/image/upload', 'uploadImage');
    Route::get('/categories/{category}/image/crop', 'cropImage');
    Route::post('/categories/{category}/image/render', 'renderImage');
    Route::get('/categories/{category}/confirm-delete', 'showConfirmDeleteForm');
    Route::post('/categories/destroy', 'destroy');
});

// CategoryController (all users)
Route::controller(CategoryController::class)->group(function () {
    Route::get('/categories', 'index');
    Route::get('/categories/{category}', 'show');
});




// DASHBORD CONTROLLER

// DashboardController (auth only)
Route::controller(DashboardController::class)->middleware('auth')->group(function(){
    Route::get('/dashboard/articles', 'articlesIndex');
    Route::get('/dashboard/categories', 'categoriesIndex');
    Route::get('/dashboard', 'index');
});
