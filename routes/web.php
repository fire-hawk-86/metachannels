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
Route::get('channel/{id}/{pageToken?}',	'Youtube@channel');

// Metachannel

Route::resource('meta',			'MetachannelController');
Route::get('user/{user}',		'MetachannelController@index_user');
Route::get('meta/{id}/update',	'MetachannelController@update_channels');
Route::get('addchannel/{test}', 'MetachannelController@add_channel');

// User

Auth::routes();
Route::delete('user/{id}', 'RemoveUserController');

// Test

Route::get('myip', function() {
	return Request::ip();
});

// Redirects

Route::get('meta', function() { return redirect('/'); });

// Static Pages

Route::get('/{page_name}', function($page_name) {
	if(View::exists("pages/$page_name"))
    {
        return view("pages/$page_name");
    }
    else
    {
        abort('404');
    }
});
