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

// Youtube

Route::get('video/{id}',				'Youtube@video');
Route::get('channel/{id}',				'Youtube@channel');
Route::get('channel/{id}/{pageToken}',	'Youtube@channel');
Route::get('search/{query}',			'Youtube@search');
Route::post('search',					'Youtube@search_get');

// Metachannel

Route::resource('meta',			'MetachannelController');
Route::get('user/{user}',		'MetachannelController@index_user');
Route::get('addchannel/{test}', 'MetachannelController@add_channel');
Route::get('meta/{id}/update',	'MetachannelController@update_channels');

// User

Route::delete('user/{id}', 'RemoveUserController');

// Redirects

Route::get('meta', function() {	return redirect('/'); });

// Auth

Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');

// search youtube channels

Route::get('searchyoutubechannel/{query}', 'YoutubeApi@search_youtube_channel')->name('searchyoutubechannel');

// Static Pages

Route::get('/{page_name}', function($page_name) {
	return view("pages/$page_name");
});
