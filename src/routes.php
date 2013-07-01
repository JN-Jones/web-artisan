<?php

Route::group(array('prefix' => Config::get('web-artisan::base_url')), function()
{
	Route::get('/', 'Jones\WebArtisan\Controllers\Cmd@index');
	Route::post('/run', 'Jones\WebArtisan\Controllers\Cmd@run');
	Route::post('/password', 'Jones\WebArtisan\Controllers\Cmd@password');
});