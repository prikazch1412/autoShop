<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('home', 'App\Http\Controllers\UserController@home');

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

// news
Route::post('news', 'App\Http\Controllers\NewsController@post');
Route::get('news', 'App\Http\Controllers\NewsController@get');
Route::get('last-news', 'App\Http\Controllers\NewsController@getLastNews');
Route::post('news/{id}', 'App\Http\Controllers\NewsController@update');
Route::get('news/{id}', 'App\Http\Controllers\NewsController@getId');
Route::post('del-news/{id}', 'App\Http\Controllers\NewsController@delete');

Route::post('comment/{id}', 'App\Http\Controllers\NewsController@postComment');

//cars
Route::get('cars', 'App\Http\Controllers\CarController@getCars');
Route::get('series', 'App\Http\Controllers\CarController@getSeries');

//service
Route::get('service', 'App\Http\Controllers\UserController@getServices');
Route::get('service/{id}', 'App\Http\Controllers\UserController@getServiceId');

Route::get('popular-services', 'App\Http\Controllers\UserController@getPopularServices');

Route::group([
    'middleware' => 'auth:api'
], function() {
    // users
    Route::get('users', 'App\Http\Controllers\UserController@getUsers');
    Route::post('user/{id}', 'App\Http\Controllers\UserController@updateUser');

    Route::get('profile', 'App\Http\Controllers\UserController@profile');
    Route::post('profile', 'App\Http\Controllers\UserController@updateProfile');
    Route::post('profile/photo', 'App\Http\Controllers\UserController@postProfilePhoto');
    Route::post('profile/del-photo/{id}', 'App\Http\Controllers\UserController@delProfilePhoto');

    // favorites
    Route::get('favorites', 'App\Http\Controllers\UserController@getFavorites');
    Route::post('favorites', 'App\Http\Controllers\UserController@postFavorites');
    Route::post('del-favorites/{id}', 'App\Http\Controllers\UserController@delFavorites');

    // orders
    Route::get('orders', 'App\Http\Controllers\OrderController@getOrders');
    Route::post('order/{id}', 'App\Http\Controllers\OrderController@postOrder');
    Route::post('del-order/{id}', 'App\Http\Controllers\OrderController@delOrder');
    Route::post('update-order/{id}', 'App\Http\Controllers\OrderController@updateOrder');

    // reviews
    Route::post('reviews/{id}', 'App\Http\Controllers\UserController@postReview');
    Route::post('del-reviews/{id}', 'App\Http\Controllers\UserController@delReview');

    // user car
    Route::post('user-car', 'App\Http\Controllers\UserController@postUserCar');
    Route::post('del-user-car/{id}', 'App\Http\Controllers\UserController@delUserCar');

    Route::post('chats', 'App\Http\Controllers\ChatController@postChat');
    Route::get('chats', 'App\Http\Controllers\ChatController@getChats');

    // chats
    Route::post('message/{chat_id}', 'App\Http\Controllers\ChatController@postMessages');
    Route::get('message/{chat_id}', 'App\Http\Controllers\ChatController@getMessages');
});
