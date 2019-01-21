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
    return view('blog');
})->name('/');

Auth::routes(
    ['verify' => true]
);

Route::get('/admin', 'HomeController@admin')->name('admin');
Route::get('/home', 'HomeController@index')->name('home');
Route::post('/send/email', 'HomeController@mail')->name('email');

Route::resource('/ads','AdController');

Route::resource('/categories','CategoryController');
Route::resource('/users','UserController');

Route::get('/about','AboutController@index')->name('about');

Route::get('/search','SearchController@search')->name('search.get');
Route::post('/search','SearchController@search')->name('search');
