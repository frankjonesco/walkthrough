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


/*
|--------------------------------------------------------------------------
| KEY DEFINITIONS
|--------------------------------------------------------------------------
|
|   INDEX.......List records
|   VIEW........View single page
|   SHOW........Show single record
|   CREATE......Show form for creating a record
|   STORE.......Save record to the database
|   EDIT........Show form to edit record
|   UPDATE......Save updated record to database
|   DESTROY.....Delete record forever
|
*/



// SITE CONTROLLER

// SiteController routes
Route::controller(SiteController::class)->group(function () {
    Route::get('/', 'index');
    Route::get('/contact', 'viewContact');
    Route::get('/terms', 'viewTerms');
    Route::get('/privacy', 'viewPrivacy');
});



// USER CONTROLLER

// UserController routes (auth only)
Route::controller(UserController::class)->middleware('auth')->group(function(){
    Route::get('profile', 'showProfile');
    Route::get('profile/edit', 'viewEditProfileForm');
    Route::post('profile/update', 'updateProfile');
    Route::get('profile/edit-password', 'viewEditPasswordForm');
    Route::post('/profile/update-password', 'updatePassword');
    Route::get('/profile/image', 'viewEditProfileImageForm');
    Route::post('/profile/image/upload', 'uploadImage');
    Route::get('/profile/image/crop', 'viewCropImageForm');
    Route::post('/profile/image/render', 'renderImage');
    Route::post('/logout', 'logout');
});

// UserController routes (guest users)
Route::controller(UserController::class)->middleware('guest')->group(function () {
    Route::get('/login', 'viewLoginForm')->name('login');
    Route::get('/signup', 'viewRegistrationForm');
    Route::post('/users/store', 'store');
    Route::post('/users/authenticate', 'authenticate');
});



// CATEGORY CONTROLLER

// CategoryController (auth users)
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
    Route::get('/categories/{category}/{slug}', 'show');
});



// ARTICLES CONTROLLER

// ArticleController routes (auth users)
Route::controller(ArticleController::class)->middleware('auth')->group(function () {
    Route::get('/articles/create', 'create');
    Route::post('/articles/store', 'store');
    Route::get('/articles/{article}/edit', 'edit');
    Route::post('/articles/{article}/update', 'update');
    Route::get('/articles/{article}/image', 'editImage');
    Route::post('/articles/{article}/image/upload', 'uploadImage');
    Route::get('/articles/{article}/image/crop', 'cropImage');
    Route::post('/articles/{article}/image/render', 'renderImage');
    Route::post('/articles/{article}/image/save-details', 'updateImageMeta');
    Route::get('/articles/{article}/confirm-delete', 'showConfirmDeleteForm');
    Route::post('/articles/destroy', 'destroy');
});

// ArticleController routes (all users)
Route::controller(ArticleController::class)->group(function () {
    Route::get('/articles', 'index');
    Route::post('/search', 'indexSearchResults');
    Route::get('/articles/{article}/{slug}', 'show');
    Route::get('/articles/{article}', 'show');
    Route::get('/tags/{tag}', 'showArticlesWithTag');
});



// DASHBORD CONTROLLER

// DashboardController (auth users)
Route::controller(DashboardController::class)->middleware('auth')->group(function(){
    Route::get('/dashboard/sandbox', 'showSandbox');
    Route::get('/dashboard/sandbox/{elements}', 'showSandbox');
    Route::get('/dashboard/articles', 'articlesIndex');
    Route::get('/dashboard/categories', 'categoriesIndex');
    Route::get('/dashboard', 'index');
});