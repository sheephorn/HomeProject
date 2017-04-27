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

$functions = app('RouteCreater')->getFunctions();
$methods = app('RouteCreater')->getMethods();

foreach ($functions as $function) {
    if ($function['method'] === $methods['get']) {
        if ($function['middleware'] !== '') {
            Route::get($function['path'], $function['controller'].'@'.$function['controllerMethod'])->name($function['@attributes']['id'])->middleware($function['middleware']);
        } else {
            Route::get($function['path'], $function['controller'].'@'.$function['controllerMethod'])->name($function['@attributes']['id']);
        }
    } elseif ($function['method'] === $methods['post']) {
        if ($function['middleware'] !== '') {
            Route::post($function['path'], $function['controller'].'@'.$function['controllerMethod'])->name($function['@attributes']['id'])->middleware($function['middleware']);
        } else {
            Route::post($function['path'], $function['controller'].'@'.$function['controllerMethod'])->name($function['@attributes']['id']);
        }
    }elseif ($function['method'] === $methods['get_post']) {
        if ($function['middleware'] !== '') {
            Route::match(['get', 'post'], $function['path'], $function['controller'].'@'.$function['controllerMethod'])->name($function['@attributes']['id'])->middleware($function['middleware']);
        } else {
            Route::match(['get', 'post'], $function['path'], $function['controller'].'@'.$function['controllerMethod'])->name($function['@attributes']['id']);
        }
    }
}
