<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Parameter\ParametersSingleton;
use App\Parameter;
use App\Parameter\ParameterObserver;
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
        $helper_path = app_path(sprintf('Helpers%sparameters.php', DIRECTORY_SEPARATOR));

        require_once($helper_path);

        new ParametersSingleton();
    }
}
