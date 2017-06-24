<?php

Route::middleware('web')
     ->namespace('\Parameter\Http\Controllers')
     ->group(function() {

// TODO: Configurable
Route::get('parameters/all','ParameterController@all')->name('parameters.all');
Route::get('parameters/categories','ParameterController@categories')->name('parameters.categories');
Route::get('parameters/logs','ParameterController@logs')->name('parameters.logs');
Route::resource('parameters','ParameterController');
     	
});


