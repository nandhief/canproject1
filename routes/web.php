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
    Route::get('slider', 'SettingController@slider')->name('slide.index');
    Route::post('slider', 'SettingController@storeSlide')->name('slide.store');
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

    /* Route careers */
    Route::resource('careers', 'CareerController');
    Route::get('careers/detail/{vacancy}', 'CareerController@detail')->name('careers.vacancy');
    Route::get('careers/detail/{vacancy}/edit', 'CareerController@vacancyEdit')->name('careers.vacancy.edit');
    Route::put('careers/detail/{vacancy}', 'CareerController@vacancyUpdate')->name('careers.vacancy.update');
    Route::delete('careers/detail/{vacancy}/delete', 'CareerController@vacancyUpdate')->name('careers.vacancy.delete');

    /* Route credits */
    Route::resource('credits', 'CreditController', ['except' => ['create', 'store']]);

    /* Route tabungans */
    Route::resource('tabungan', 'TabunganController', ['except' => ['create', 'store']]);
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