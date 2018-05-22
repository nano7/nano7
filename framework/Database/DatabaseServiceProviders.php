<?php namespace Nano7\Database;

use Nano7\Support\ServiceProvider;

class DatabaseServiceProviders extends ServiceProvider
{
    /**
     * Register objetos base.
     */
    public function register()
    {
        $this->app->singleton('db', function () {
            return new DataManager($this->app, $this->app['config']->get('database', []));
        });
    }
}