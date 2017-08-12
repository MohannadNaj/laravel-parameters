<?php

namespace Parameter\Providers;

use Illuminate\Support\ServiceProvider;
use Parameter\ParametersSingleton;
use Parameter\Parameter;
use Parameter\ParameterObserver;
use Parameter\Helpers\DirectorySeparatorTrait;

class ParametersServiceProvider extends ServiceProvider
{
    use DirectorySeparatorTrait;
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {

        $this->loadMigrationsFrom($this->formatPath(__DIR__.'/../database/migrations'));
        $this->loadViewsFrom($this->formatPath(__DIR__.'/../resources/views'), 'parameters');
        $this->loadRoutesFrom($this->formatPath(__DIR__.'/../routes.php'));
        $this->publishes(
            [
                $this->formatPath(__DIR__.'/../public/vendor') => public_path('vendor'),
            ], 'public');

        view()->composer('parameters::shared.parameters-head', function($view) {
            $view->with('parametersColumns', \Parameter\Parameter::getColumns());
        });

        Parameter::observe(ParameterObserver::class);
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        require_once($this->formatPath(__DIR__. '/../Helpers/parameters.php'));
        new ParametersSingleton();

    }
}
