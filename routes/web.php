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

Auth::routes();

/**
 * Route Backend
 */
Route::middleware('guest')->group(function () {
    Route::get('/', 'SettingController@dashboard')->name('dashboard');
    Route::resource('settings', 'SettingController', [
        'except' => [
            'create', 'store', 'destroy',
        ]
    ]);
    Route::resource('users', 'UserController');
    Route::resource('news', 'NewsController');
    Route::resource('promos', 'PromoController');
    Route::resource('lelang', 'LelangController');
    Route::resource('layanan', 'LayananController');
    Route::resource('commodities', 'CommodityController');
    Route::resource('products', 'ProductController');
    Route::resource('careers', 'CareerController', ['except' => ['create', 'store']]);
});

/**
 * Route Auth
 */
Route::get('activation/{token}', 'SettingController@activation')->name('activation');
Route::get('reset/password/{token}', 'SettingController@resetForm');

Route::get('test', function () {
    return view('mails.careers');
    $user = App\User::first();
    return new App\Mail\RegisterMail($user);
});