<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class ParametersServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
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

        // create a parameters singleton
        app()->singleton('parameter', function () {
            return \App\Parameter::all();
        });
    }
}
