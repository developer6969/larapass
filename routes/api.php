<?php

use Illuminate\Http\Request;

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

// For User Registrtation
Route::post('registration', 'Api\Auth\RegisterController@register');

// For User Login & Logout
Route::post('login', 'Api\Auth\LoginController@login');
Route::post('refresh', 'Api\Auth\LoginController@refresh');
Route::post('logout', 'Api\Auth\LoginController@logout');

Route::middleware('auth:api')->group(function() {
    Route::post('logout','Api\Auth\LoginController@logout');
    Route::get('posts', 'Api\PostController@index');
    Route::get('user', function (Request $request) {
        return $request->user();
    });
});
