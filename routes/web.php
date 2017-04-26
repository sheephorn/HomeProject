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

// Auth::routes();

// Route::('login', '\App\Http\Controllers\LoginController');

$prefix = 'login';
Route::group(['prefix' => $prefix], function(){
    // Loginページの表示
    Route::get('/', 'LoginController@getLoginPage')->route('login');
    // Login機能
    Route::post('/', 'LoginController@login');
});

Route::group(['middleware' => 'login'], function(){
    //
});
