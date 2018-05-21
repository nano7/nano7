<?php namespace Nano7\Http;

use Nano7\Support\ServiceProvider;

class WebServiceProviders extends ServiceProvider
{
    /**
     * Register objetos para web.
     */
    public function register()
    {
        $this->registerUrls();

        $this->registerRouting();
    }

    /**
     * Register urls.
     */
    protected function registerUrls()
    {
        $this->app->singleton('url', function () {
            return new UrlGenerator($this->app['request']);
        });
    }

    /**
     * Register routing.
     */
    protected function registerRouting()
    {
        $this->app->singleton('router', function () {
            return new \Nano7\Http\Routing\Router();
        });
    }
}