<?php namespace Nano7\Foundation;

use Nano7\Foundation\Support\ServiceProvider;

class FoundationServiceProviders extends ServiceProvider
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
            return new \Nano7\Foundation\Events\Dispatcher($this->app);
        });
    }

    /**
     * Register files.
     */
    protected function registerFiles()
    {
        $this->app->singleton('files', function () {
            return new \Nano7\Foundation\Support\Filesystem();
        });
    }

    /**
     * Register configs.
     */
    protected function registerConfigs()
    {
        $this->app->singleton('config', function () {
            return new \Nano7\Foundation\Config\Repository();
        });
    }
}