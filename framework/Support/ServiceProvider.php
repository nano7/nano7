<?php namespace Nano7\Support;

use Nano7\Application;

abstract class ServiceProvider
{
    /**
     * The application instance.
     *
     * @var Application
     */
    protected $app;

    /**
     * Create a new service provider instance.
     *
     * @param  Application $app
     * @return void
     */
    public function __construct($app)
    {
        $this->app = $app;
    }

    /**
     * Merge the given configuration with the existing configuration.
     *
     * @param  string  $path
     * @param  string  $key
     * @return void
     */
    protected function mergeConfigFrom($path, $key)
    {
        $config = $this->app['config']->get($key, []);

        $this->app['config']->set($key, array_merge(require $path, $config));
    }

    /**
     * Register a view file namespace.
     *
     * @param  string  $path
     * @param  string  $namespace
     * @return void
     */
    /*protected function loadViewsFrom($path, $namespace)
    {
        if (is_dir($appPath = $this->app->resourcePath().'/views/vendor/'.$namespace)) {
            $this->app['view']->addNamespace($namespace, $appPath);
        }

        $this->app['view']->addNamespace($namespace, $path);
    }/**/
}