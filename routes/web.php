<?php

// Basic Laravel Authentication routes
Auth::routes();

Route::get('/', 'HomeController@index')->name('home');
Route::get('/overzicht', 'OverzichtController@index')->name('overzicht');
Route::get('/profiel', 'ProfielController@index')->name('profiel');
