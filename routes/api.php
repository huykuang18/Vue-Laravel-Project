<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['prefix' => 'auth', 'namespace' => 'App\Http\Controllers',],function(){
    Route::post('register', 'UserController@register');
    Route::post('login', 'UserController@login');

    Route::get('post','PostController@getAllPost');
    Route::get('post/detail/{id}','PostController@showPost');
    Route::post('post/create','PostController@createPost');
    Route::put('post/edit/{id}','PostController@editPost');
    Route::delete('post/delete/{id}','PostController@deletePost');
});

Route::group(['middleware' => 'jwt.auth', 'namespace' => 'App\Http\Controllers'], function () {
    Route::get('user-info', 'UserController@getUserInfo');
    Route::get('logout', 'UserController@logout');
});
