<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

//auth
Route::post('register', 'App\Http\Controllers\AuthController@register');
Route::post('login', 'App\Http\Controllers\AuthController@login');
Route::post('login-admin', 'App\Http\Controllers\AuthController@loginAdmin');

Route::post('img', 'App\Http\Controllers\UserController@img');

//services
Route::get('services', 'App\Http\Controllers\ServiceController@get');
Route::get('services-items', 'App\Http\Controllers\ServiceController@getItems');

//regions
Route::get('regions', 'App\Http\Controllers\CityController@getRegions');
Route::get('city', 'App\Http\Controllers\CityController@getCity');

//cars
Route::get('cars', 'App\Http\Controllers\CarController@getCars');
Route::get('series', 'App\Http\Controllers\CarController@getSeries');

Route::group([
    'middleware' => 'auth:api'
], function() {
    // users
    Route::get('profile', 'App\Http\Controllers\UserController@profile');
    Route::post('profile', 'App\Http\Controllers\UserController@updateProfile');
    Route::post('profile/photo', 'App\Http\Controllers\UserController@postProfilePhoto');
    Route::post('profile/del-photo/{id}', 'App\Http\Controllers\UserController@delProfilePhoto');

    Route::get('service', 'App\Http\Controllers\UserController@getServices');
    Route::get('service/{id}', 'App\Http\Controllers\UserController@getServiceId');

    // orders
    Route::post('order/{id}', 'App\Http\Controllers\OrderController@postOrder');
    Route::post('del-order/{id}', 'App\Http\Controllers\OrderController@delOrder');
    Route::post('update-order/{id}', 'App\Http\Controllers\OrderController@updateOrder');

    // reviews
    Route::post('reviews/{id}', 'App\Http\Controllers\UserController@postReview');
    Route::post('del-reviews/{id}', 'App\Http\Controllers\UserController@delReview');

    // user car
    Route::post('user-car', 'App\Http\Controllers\UserController@postUserCar');
    Route::post('del-user-car/{id}', 'App\Http\Controllers\UserController@delUserCar');

    Route::get('popular-services', 'App\Http\Controllers\UserController@getPopularServices');
});
