<?php

// use Illuminate\Http\Request;

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
Route::namespace('Api')->group(function () {
    Route::get('dashboard', 'InfoController@dashboard');
    Route::get('news', 'InfoController@listNews');
    Route::get('news/{news}', 'InfoController@news');
    Route::get('promo', 'InfoController@listPromo');
    Route::get('promo/{promo}', 'InfoController@promo');
    Route::get('lelang', 'InfoController@listLelang');
    Route::get('lelang/{lelang}', 'InfoController@lelang');
    Route::get('commodity', 'InfoController@listCommodity');
    Route::get('commodity/{commodity}', 'InfoController@commodity');
    Route::get('valas', 'InfoController@valas');
});
Route::post('career', 'ApiController@career');
Route::post('login', 'ApiController@login');
Route::post('register', 'ApiController@register');
Route::post('forgot', 'ApiController@forgot');

