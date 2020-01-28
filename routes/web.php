<?php

// Basic Laravel Authentication routes
Auth::routes();

Route::get('/', 'HomeController@index')->name('home');
Route::get('/overzicht', 'OverzichtController@index')->name('overzicht');
Route::get('/profiel', 'ProfielController@index')->name('profiel');

Route::patch('/profiel/{user}',
    ['as' => 'profiel.update', 'uses' => 'ProfielController@update']
);

Route::post('/track-time', 'HomeController@trackTime');

Route::get('/times/{user}',
    ['as' => 'times', 'uses' => 'TimesController@getTimes']
);

Route::get('/user/id', function () {
    return Auth::user()->id;
});
