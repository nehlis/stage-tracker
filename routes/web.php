<?php

// Basic Laravel Authentication routes
Auth::routes();

Route::get('/', 'HomeController@index')->name('home');
