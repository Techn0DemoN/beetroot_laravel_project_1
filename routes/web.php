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

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/', 'PostController@index')->name('home');
Route::get('/article/{id}', 'PostController@article')->name('article_by_id');
Route::get('/category/{id}', 'PostController@indexCategoryFilter')->name('category_filter');
Route::any('/search', 'SearchController@search')->name('article_search');
Route::post('/search-ajax', 'SearchController@getSearchOptionsAjax')->name('SearchOptions');

Route::middleware(['auth'])->group(function () {
    Route::post('/add_post', 'PostController@addPost')->name('add_post');
    Route::get('/add_post', 'PostController@add')->name('create_post');
    Route::post('/change_like', 'LikeController@changeLikeAjax')->name('change_like_status_ajax');
    Route::any('/parsing_obyava', 'ParsingObyavaUaController@index')->name('parisng_obyava');
    Route::any('/parsing_olx', 'ParsingOlxController@index')->name('parsing_olx');
});

