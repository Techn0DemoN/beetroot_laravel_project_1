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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/', 'PostController@index')->name('home');
Route::post('/weather-ajax', 'PostController@getWeather')->name('weather');
Route::get('/article/{id}', 'PostController@article')->name('article_by_id');

//likes
Route::post('/article/{id}/like', 'PostController@getLike')->name('like');

Route::middleware(['auth'])->group(function () {
    Route::post('/add_post', 'PostController@addPost')->name('add_post');
    Route::get('/add_post', 'PostController@add')->name('create_post');
});

//Categories


Route::get('/{title}', 'CategoryController@index')->name('category');


