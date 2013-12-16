<?php namespace Maxxscho\LaravelTcpdf;

use Illuminate\Support\ServiceProvider;
use Illuminate\Foundation\AliasLoader;

class LaravelTcpdfServiceProvider extends ServiceProvider {

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
		$this->package('maxxscho/laravel-tcpdf');

		AliasLoader::getInstance()->alias('PDF', 'Maxxscho\LaravelTcpdf\Facades\LaravelTcpdfFacade');
	}

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
		$this->app['pdf'] = $this->app->share(function($app)
		{
			return new LaravelTcpdf;
		});
	}

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
		return array('pdf');
	}

}