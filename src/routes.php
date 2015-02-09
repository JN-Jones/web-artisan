<?php

//Route::group(array('prefix' => config('web-artisan.base_url'), 'middleware' => config('web-artisan.auth_filter')), function()
Route::group(array('prefix' => config('web-artisan.base_url')), function()
{
	Route::get('/', 'Jones\WebArtisan\Controllers\Cmd@index');
	Route::post('/run', 'Jones\WebArtisan\Controllers\Cmd@run');
	Route::post('/password', 'Jones\WebArtisan\Controllers\Cmd@password');
});