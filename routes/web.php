<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/list', 'BoardController@index')->name('list');

Route::get('/create', 'BoardController@create');

Route::post('/store', 'BoardController@store');

Route::get('/show/{id}', 'BoardController@show');

Route::get('/edit/{id}', 'BoardController@edit');

Route::post('/update/{id}', 'BoardController@update');

Route::get('/delete/{id}', 'BoardController@destroy');

Route::get('/myabout/{id}', 'MypageController@show');

Route::get('/myedit/{id}', 'MypageController@edit');

Route::post('/myupdate/{id}', 'MypageController@updateProfile');

Route::post('/myupdate/{id}', 'MypageController@update');

// Route::resource('boards', 'BoardController');