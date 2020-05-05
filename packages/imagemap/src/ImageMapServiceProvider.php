<?php
namespace BaoDo\ImageMap;
use Illuminate\Support\ServiceProvider;

Class ImageMapServiceProvider extends ServiceProvider
{
    public function boot() {
        $this->loadRoutesFrom(__DIR__.'/Routes/web.php');
        $this->loadViewsFrom(__DIR__.'/Resources/views', 'imagemap');
        $this->loadMigrationsFrom(__DIR__ . '/../../database/migrations');
        $this->loadTranslationsFrom(__DIR__.'/../Resources/lang', 'imagemap');
    
        $this->publishes([
	        __DIR__.'/Resources/assets' => public_path('packages/imagemap'),
	    ], 'public');
    }

    public function register() {
    	$this->app->make('BaoDo\ImageMap\Http\Controllers\ImageMapController');
    }
}