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
Route::namespace('Api')->group(function () {
    Route::get('dashboard', 'InfoController@dashboard');
    Route::get('news', 'InfoController@listNews');
    Route::get('news/{news}', 'InfoController@news');
    Route::get('layanan', 'InfoController@listLayanan');
    Route::get('layanan/{layanan}', 'InfoController@layanan');
    Route::get('promo', 'InfoController@listPromo');
    Route::get('promo/{promo}', 'InfoController@promo');
    Route::get('product', 'InfoController@listProduct');
    Route::get('product/{product}', 'InfoController@product');
    Route::get('commodity', 'InfoController@commodity');
    Route::get('lelang', 'InfoController@listLelang');
    Route::get('lelang/{lelang}', 'InfoController@lelang');
    Route::get('valas', 'InfoController@valas');
    Route::get('slider', 'InfoController@slider');
    Route::get('about', 'InfoController@about');
    Route::get('contacts', 'InfoController@contacts');
    Route::get('corporates', 'InfoController@corporates');
});
Route::middleware('auth:api')->group(function () {
    Route::namespace('Api')->group(function () {
        Route::get('vacancy', 'InfoController@listVacancy');
        Route::get('vacancy/{vacancy}', 'InfoController@vacancy');
    });
    Route::post('career', 'ApiController@career');
    Route::post('user/update', 'ApiController@update_user');
    Route::post('user/password', 'ApiController@password_user');
    Route::post('credit', 'ApiController@credit');
    Route::post('tabungan', 'ApiController@tabungan');
    Route::get('history/{history}', 'ApiController@history');
});
Route::post('register', 'ApiController@register');
Route::post('forgot', 'ApiController@forgot');
Route::post('login', 'ApiController@login');
Route::post('otp', 'ApiController@login_otp');
