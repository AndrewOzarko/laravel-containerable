<?php

namespace Ozarko\Containerable\Providers;

use Illuminate\Support\Facades\App;
use Illuminate\Support\ServiceProvider;
use Ozarko\Containerable\Commands\ContainerableInstallCommand;
use Ozarko\Containerable\Services\Container;

class ContainerServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        App::bind('laravel-container', function ()
        {
            return new Container();
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        if ($this->app->runningInConsole()) {

            $this->commands([
                ContainerableInstallCommand::class,
            ]);
        }
    }
}
