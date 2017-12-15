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



//Route::resource('meta', 'MetachannelController');

Route::get('addchannel/{test}', 'MetachannelController@add_channel');

// Video
Route::get('video/{id}', 'VideoController');

// Video Search
Route::get('search/{query}', 'VideoSearchController');
Route::post('search', 'VideoSearchController@processForm');

// MetachannelController
Route::get(		'meta/{id}/edit',	'MetachannelController@edit');
Route::get(		'meta/new',			'MetachannelController@create');
Route::get(		'meta/{id}',		'MetachannelController@show');
Route::get(		'/',				'MetachannelController@index');
Route::post(	'meta',				'MetachannelController@store');
Route::put(		'meta/{id}',		'MetachannelController@update');
Route::delete(	'meta/{id}',		'MetachannelController@destroy');

// UpdateController
Route::get('meta/{id}/update', 'UpdateController@metachannel');

// Redirects
Route::get('meta', function() {	return redirect('/'); });
