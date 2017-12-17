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

Route::get('video/{id}',		'VideoController');

Route::get('channel/{id}',		'ChannelController');

Route::get('search/{query}',	'VideoSearchController');
Route::post('search',			'VideoSearchController@processForm');

Route::resource('meta',			'MetachannelController');
Route::get('addchannel/{test}', 'MetachannelController@add_channel');

Route::get('meta/{id}/update',	'UpdateController@metachannel');

// Redirects
Route::get('meta', function() {	return redirect('/'); });
