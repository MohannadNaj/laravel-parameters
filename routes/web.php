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

// TODO: Configurable
Route::get('parameters/all','ParameterController@all')->name('parameters.all');
Route::get('parameters/categories','ParameterController@categories')->name('parameters.categories');
Route::get('parameters/logs','ParameterController@logs')->name('parameters.logs');
Route::resource('parameters','ParameterController');
