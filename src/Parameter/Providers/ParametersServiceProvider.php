<?php

namespace Parameter\Providers;

use Illuminate\Support\ServiceProvider;
use Parameter\ParametersSingleton;
use Parameter\Parameter;
use Parameter\ParameterObserver;
class ParametersServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {

        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'parameters');
        $this->loadRoutesFrom(__DIR__.'/../routes.php');
        $this->publishes([
                __DIR__.'/../public/vendor' => public_path('vendor'),
            ], 'public');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $helper_path = __DIR__. sprintf('%1$s..%1$shelpers%1$sparameters.php', DIRECTORY_SEPARATOR);
        require_once($helper_path);
        new ParametersSingleton();

        Parameter::observe(ParameterObserver::class);
    }
}
