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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::get('/home', 'HomeController@index')->name('home');

//인증
Route::post('auth/register', 'AuthController@register');

Route::post('auth/login', 'AuthController@login'); 

//인증된 사용자면 라우트 접근 가능
Route::group([ 'middleware'=> 'jwt.auth'], function () { 
    Route::get( 'auth/user', 'AuthController@user'); 
    Route::get('auth/logout', 'AuthController@logout');

//마이페이지 
Route::get('/myabout', 'MypageController@show');
Route::get('/myedit', 'MypageController@edit');
Route::post('/myupdate', 'MypageController@update');
Route::get('/mycheck', 'MypageController@checkshow');

//예약
Route::post('/ownerstore', 'ShipController@ownerstore');
Route::post('/shipstore', 'ShipController@shipstore');
Route::post('/rentalstore', 'ShipController@rentalstore');
}); 

Route::group([ 'middleware'=> 'jwt.refresh'], function () { 
    Route::get( 'auth/refresh', 'AuthController@refresh'); 
});



//커뮤니티
Route::get('/list', 'BoardController@index')->name('list');

Route::get('/create', 'BoardController@create');

Route::post('/store', 'BoardController@store');

Route::get('/show/{id}', 'BoardController@show');

Route::get('/edit/{id}', 'BoardController@edit');

Route::post('/update/{id}', 'BoardController@update');

Route::get('/delete/{id}', 'BoardController@destroy');

//예약
Route::get('/recreate/{id}', 'ShipController@create');

Route::post('/reservation/{id}', 'ShipController@rentalStore');

Route::get('/shipshow/{id}', 'ShipController@shipshow');

//날씨 정보
Route::get('/weather', 'WeatherInformationsController@weather');

//물때 정보
Route::get('/tide', 'TideInformationsController@tide');

//낚시터 정보
Route::get('/fishing', 'FishingPlacesController@fishing');
