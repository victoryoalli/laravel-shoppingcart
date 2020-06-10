<?php

namespace VictorYoalli\Shoppingcart;

use Illuminate\Auth\Events\Logout;
use Illuminate\Session\SessionManager;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\ServiceProvider;

class ShoppingcartServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        /*
         * Optional methods to load your package assets
         */
        // $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'shoppingcart');
        // $this->loadViewsFrom(__DIR__.'/../resources/views', 'shoppingcart');
        // $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        // $this->loadRoutesFrom(__DIR__.'/routes.php');

        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../config/config.php' => config_path('shoppingcart.php'),
            ], 'config');

            // Publishing the views.
            /*$this->publishes([
                __DIR__.'/../resources/views' => resource_path('views/vendor/shoppingcart'),
            ], 'views');*/

            // Publishing assets.
            /*$this->publishes([
                __DIR__.'/../resources/assets' => public_path('vendor/shoppingcart'),
            ], 'assets');*/

            // Publishing the translation files.
            /*$this->publishes([
                __DIR__.'/../resources/lang' => resource_path('lang/vendor/shoppingcart'),
            ], 'lang');*/

            //Migrations
            if (! class_exists('CreateShoppingcartTable')) {
                // Publish the migration
                $timestamp = date('Y_m_d_His', time());
                $this->publishes([
                    __DIR__.'/../database/migrations/create_shoppingcart_table.stub' => database_path('migrations/'.$timestamp.'_create_shoppingcart_table.php'),
                ], 'migrations');
            }

            // Registering package commands.
            // $this->commands([]);
        }
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        // Automatically apply the package configuration
        $this->mergeConfigFrom(__DIR__.'/../config/config.php', 'shoppingcart');

        // Register the main class to use with the facade
        $this->app->singleton('shoppingcart', function ($app) {
            return new Cart($app['session'], $app['events']);
        });

        Event::listen(Logout::class, function () {
            if (config('shoppingcart.destroy_on_logout')) {
                $this->app->make(SessionManager::class)->forget('shoppingcart');
            }
        });
    }
}
