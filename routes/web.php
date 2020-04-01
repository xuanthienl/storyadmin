<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('login', 'UserController@login')->name('login');
Route::post('login', 'UserController@postlogin')->name('postlogin');

Route::get('register', 'UserController@register')->name('register');
Route::post('register', 'UserController@postregister')->name('postregister');

Route::get('logout', 'UserController@logout')->name('logout');


Route::group(['prefix'=>'admin', 'middleware'=> 'auth'],function() {
//Route::prefix('admin')->group(function() {
    //TRANG STORY ADMIN
    Route::get('stories', 'Storycontroller@indexstory')->name('stories.index');

    Route::get('stories/create', 'Storycontroller@create')->name('stories.create');
    Route::post('stories', 'Storycontroller@store')->name('stories.store');

    Route::delete('stories/{id}', 'Storycontroller@destroy')->name('stories.destroy');

    Route::get('stories/{id}/edit', 'Storycontroller@edit')->name('stories.edit');
    Route::put('stories/{id}', 'Storycontroller@update')->name('stories.update');
    Route::get('show/{id}', 'Storycontroller@show')->name('stories.show');

    //TRANG CATGORY ADMIN
    Route::get('categories', 'CategoryController@index')->name('categories.index');

    Route::get('categories/create', 'CategoryController@create')->name('categories.create');
    Route::post('categories', 'CategoryController@store')->name('categories.store');

    Route::delete('categories/{id}', 'CategoryController@destroy')->name('categories.destroy');

    Route::get('categories/{id}/edit', 'CategoryController@edit')->name('categories.edit');
    Route::put('categories/{id}', 'CategoryController@update')->name('categories.update');

    //TRANG USER ADMIN
    Route::get('user', 'UserController@index')->name('user.index');
    Route::delete('user/{id}', 'UserController@destroy')->name('user.destroy');
    Route::get('user/{id}/edit', 'UserController@edit')->name('user.edit');
    Route::put('user/{id}', 'UserController@update')->name('user.update');
    Route::get('user-restore/{id}','UserController@restore')->name('user.restore');
    Route::get('user-forcedelete/{id}', 'UserController@forcedelete')->name('user.forcedelete');

    Route::get('profile/', 'UserController@edit_profile')->name('edit_profile');
    Route::put('profile/{id}', 'UserController@update_profile')->name('update_profile');

    //PAGE SHOW, XÓA VĨNH VIỄN, HOẶC KHÔI PHỤC CATEGORY ĐÃ BỊ XÓA
    Route::get('restore', 'CategoryController@restore')->name('restore');
    Route::get('restore/{id}', 'CategoryController@postrestore')->name('postrestore');
    Route::get('delete/{id}', 'CategoryController@delete')->name('delete');

    //PAGE SHOW, XÓA VĨNH VIỄN, HOẶC KHÔI PHỤC STORY ĐÃ BỊ XÓA
    Route::get('restore-story', 'Storycontroller@restore')->name('restore-story');
    Route::get('restore-story/{id}', 'Storycontroller@postrestore')->name('restore_story');
    Route::get('delete-story/{id}', 'Storycontroller@delete')->name('delete_story');

    //TRANG CHỦ ADMIN
    Route::get('dashboard','HomeController@dashboard')->name('dashboard');
});

Route::get('search','HomeController@search')->name('search')->middleware('auth.basic');
//->middleware('auth.basic') để vào page search mà ko cần qua login, nhưng làm ko dc 
Route::get('home', 'HomeController@index')->name('home');

Route::get('category/{id}', 'HomeController@PageCategory')->name('PageCategory');
Route::get('story/{id}', 'HomeController@PageStory')->name('PageStory');
