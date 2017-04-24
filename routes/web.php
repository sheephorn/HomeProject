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
Route::get('/git/pull', function () {
    $command = "--git-dir=/var/www/html/HomeProject/.git pull";
    $ret = system($command);
    echo $ret;
    return "\nGIT OK";
});

Route::get('/test', function() {
    return view('test');
});

Auth::routes();

Route::get('/home', 'HomeController@index');
