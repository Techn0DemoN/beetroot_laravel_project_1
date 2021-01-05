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
Route::get('/article/{id}', 'PostController@article')->name('article_by_id');
Route::get('/category/{id}', 'PostController@indexCategoryFilter')->name('category_filter');
Route::post('change_like', 'LikeController@changeLikeAjax')->name('change_like_status_ajax');

Route::middleware(['auth'])->group(function (){
    Route::post ('/add_post', 'PostController@addPost')->name('add_post');
    Route::get('/add_post', 'PostController@add')->name('create_post');
});

