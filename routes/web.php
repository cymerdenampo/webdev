<?php

use App\Http\Controllers\Auth\AdminController;
use App\Http\Controllers\Auth\UserRegistrationController;
use Illuminate\Support\Facades\Route;

Route::get('/', 'IndexController@index')->name('welcomei');

Route::resource('/lot', 'LotController');

Route::get('/login/user', [UserRegistrationController::class, 'showLoginForm'])->name('user.login');
Route::post('/login/user', [UserRegistrationController::class, 'login']);
Route::get('/register/user', [UserRegistrationController::class, 'showRegistrationForm'])->name('user.register');
Route::post('/register/user', [UserRegistrationController::class, 'register']);

Route::get('/LLadmin', [AdminController::class, 'showLoginForm'])->name('admin.login');
Route::post('/LLadmin', [AdminController::class, 'login']);

Auth::routes(['verify' => true]);

Route::get('/home', 'HomeController@index')->name('home')->middleware(['verified']);

//admin access only
Route::group(['middleware' => ['auth', 'role:admin', 'verified']], function () {
    Route::resource('user-list', 'UserListController');
    // Route::resource('feature-payments', 'FeatureListController');
    Route::resource('payments', 'PaymentsController');
});

// user and admin access only
Route::group(['middleware' => ['auth', 'role:user|admin', 'verified', 'checkUserInfo']], function () {
    Route::resource('settings-and-privacy', 'MyAccountController');
    // Route::resource('wishlist', 'WishlistController');
    Route::post('/email', 'EmailController@email');
});

//user access only
Route::group(['middleware' => ['auth', 'role:user', 'verified', 'checkUserInfo']], function () {
    Route::resource('my-listings', 'MyListingsController')->middleware('checkUserPlan:standard,premium');
});

Route::get('/auth/facebook', 'Auth\LoginController@redirectToFacebook');
Route::get('/auth/facebook/callback', 'Auth\LoginController@handleFacebookCallback');

Route::get('/auth/google', 'Auth\LoginController@redirectToGoogle');
Route::get('/auth/google/callback', 'Auth\LoginController@handleGoogleCallback');

Route::resource('/buy', 'BuyController');
Route::resource('/lease', 'RentController');
Route::resource('/sold', 'SoldController');
Route::resource('/search', 'SearchController');
Route::resource('/pricing', 'PricingController');
Route::get('/terms', 'StaticPagesController@terms');
Route::get('/privacy-policy', 'StaticPagesController@policy');
Route::get('/about-us', 'StaticPagesController@aboutus');

Route::get('index', 'CrudsController@index');
Route::resource('/crud', 'CrudsController');