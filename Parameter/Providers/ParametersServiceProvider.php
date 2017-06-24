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
        Parameter::observe(ParameterObserver::class);
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $helper_path = base_path(sprintf('Parameter%1$sHelpers%1$sparameters.php', DIRECTORY_SEPARATOR));

        require_once($helper_path);

        new ParametersSingleton();
    }
}
