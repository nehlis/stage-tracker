<?php

// Basic Laravel Authentication routes
Auth::routes();

Route::get('/', 'HomeController@index')->name('home');
Route::get('/overzicht', 'OverzichtController@index')->name('overzicht');
Route::get('/profiel', 'ProfielController@index')->name('profiel');

Route::post('/track-time', 'HomeController@trackTime');

Route::get('/user/id', function () {
    return Auth::user()->id;
});
