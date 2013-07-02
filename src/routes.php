<?php

Route::group(array('prefix' => Config::get('web-artisan::base_url'), 'before' => Config::get('web-artisan::auth_filter')), function()
{
	Route::get('/', 'Jones\WebArtisan\Controllers\Cmd@index');
	Route::post('/run', 'Jones\WebArtisan\Controllers\Cmd@run');
	Route::post('/password', 'Jones\WebArtisan\Controllers\Cmd@password');
});