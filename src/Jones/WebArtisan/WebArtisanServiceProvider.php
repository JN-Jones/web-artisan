<?php namespace Jones\WebArtisan;

use Illuminate\Support\ServiceProvider;

class WebArtisanServiceProvider extends ServiceProvider {

	/**
	 * Indicates if loading of the provider is deferred.
	 *
	 * @var bool
	 */
	protected $defer = false;

	/**
	 * Bootstrap the application events.
	 *
	 * @return void
	 */
	public function boot()
	{
		$this->publishes([
			__DIR__.'/../../config/config.php' => config_path('web-artisan.php'),
			__DIR__.'/../../../public' => base_path('public/packages/jones/web-artisan'),
		]);
		$this->loadViewsFrom(__DIR__.'/../../views', 'web-artisan');
		$this->loadTranslationsFrom(__DIR__.'/../../lang', 'web-artisan');
		include __DIR__ . '/../../routes.php';
	}

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
		//
	}

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
		return array();
	}

}