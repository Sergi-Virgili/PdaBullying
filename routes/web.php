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
    return view('iframe');
});

Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');
Route::get('/map/{map}', 'HomeController@iframe')->name('iframe');

//Route::get('/admin/publicar', 'HomeController@publish')->name('publish');

Route::any('{all}', function () {
    return view('home');
})->where(['all' => '.*']);



