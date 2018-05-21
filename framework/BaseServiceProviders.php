<?php namespace Nano7;

use Nano7\Support\ServiceProvider;

class BaseServiceProviders extends ServiceProvider
{
    /**
     * Register objetos base.
     */
    public function register()
    {
        $this->registerEvents();

        $this->registerFiles();

        $this->registerConfigs();
    }

    /**
     * Register events.
     */
    protected function registerEvents()
    {
        $this->app->singleton('events', function () {
            return new \Nano7\Events\Dispatcher($this->app);
        });
    }

    /**
     * Register files.
     */
    protected function registerFiles()
    {
        $this->app->singleton('files', function () {
            return new \Nano7\Support\Filesystem();
        });
    }

    /**
     * Register configs.
     */
    protected function registerConfigs()
    {
        $this->app->singleton('config', function () {
            return new \Nano7\Config\Repository();
        });
    }
}