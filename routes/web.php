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

Route::get('/', 'PostsController@index');
Route::delete('/p/{id}', 'PostsController@destroy');
Route::get('/p/{post}/edit', 'PostsController@edit');
Route::patch('/p/{post}', 'PostsController@update');
Route::get('/email', function() {
    return new \App\Mail\NewUserWelcomeMail();
});

Route::post('/follow/{user}', 'FollowsController@store');

Auth::routes();
Route::get('/p/create', 'PostsController@create');
Route::get('/p/{post}', 'PostsController@show');
Route::post('/p', 'PostsController@store');

Route::get('/profile/{user}', 'ProfilesController@index')->name('profile.show');
Route::get('/profile/{user}/edit', 'ProfilesController@edit')->name('profile.edit');
Route::patch('/profile/{user}', 'ProfilesController@update')->name('profile.update');
Route::get('/searching/{user}', 'ProfilesController@search')->name('profile.searching');

Route::post('/like','PostsController@postLikePost')->name('like');


