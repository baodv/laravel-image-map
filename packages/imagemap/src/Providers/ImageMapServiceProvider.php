<?php
namespace BaoDo\ImageMap\Providers;
use Illuminate\Support\ServiceProvider;

Class ImageMapServiceProvider extends ServiceProvider
{
    public function boot() {
        $this->loadRoutesFrom(__DIR__.'/../../routes/web.php');
        $this->loadViewsFrom(__DIR__.'/../../resources/views', 'imagemap');
        $this->loadMigrationsFrom(__DIR__ . '/../../database/migrations');
        $this->loadTranslationsFrom(__DIR__.'/../../resources/lang', 'imagemap');
    
        $this->publishes([
	        __DIR__.'/resources/assets' => public_path('packages/imagemap'),
	    ], 'public');
    }

    public function register() {
    	$this->app->make('BaoDo\ImageMap\Http\Controllers\ImageMapController');
    }
}