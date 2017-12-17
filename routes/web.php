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



Route::get('/', 'MetachannelController@index');

Route::get('video/{id}',		'Youtube@video');
Route::get('channel/{id}',		'Youtube@channel');
Route::get('search/{query}',	'Youtube@search');
Route::post('search',			'Youtube@search_get');

Route::resource('meta',			'MetachannelController');
Route::get('addchannel/{test}', 'MetachannelController@add_channel');
Route::get('meta/{id}/update',	'MetachannelController@update_channels');

// Redirects
Route::get('meta', function() {	return redirect('/'); });

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
