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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('stories/like/{id}', 'Storycontroller@like')->name('like');
Route::post('stories/dislike/{id}', 'Storycontroller@dislike')->name('dislike');

Route::get('api-category','APIControllerCategory@index');
Route::get('api-category/{id}','APIControllerCategory@show');
Route::post('api-category','APIControllerCategory@store');
Route::put('api-category/{id}','APIControllerCategory@update');
Route::delete('api-category/{id}','APIControllerCategory@destroy');

Route::get('api-story','APIControllerStory@index');
Route::get('api-story/{id}','APIControllerStory@show');
Route::post('api-story','APIControllerStory@store');
Route::put('api-story/{id}','APIControllerStory@update');
Route::delete('api-story/{id}','APIControllerStory@destroy');

Route::post('register', 'APIControllerUser@register');
Route::post('login', 'APIControllerUser@login');