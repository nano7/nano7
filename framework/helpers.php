<?php

use Carbon\Carbon;
use Illuminate\Container\Container;

if (! function_exists('app')) {
    /**
     * Get the available container instance.
     *
     * @param  string  $abstract
     * @param  array   $parameters
     * @return mixed|\Nano7\Application
     */
    function app($abstract = null, array $parameters = [])
    {
        if (is_null($abstract)) {
            return Container::getInstance();
        }

        return Container::getInstance()->make($abstract, $parameters);
    }
}

if (! function_exists('base_path')) {
    /**
     * Get the path to the base of the install.
     *
     * @param  string  $path
     * @return string
     */
    function base_path($path = '')
    {
        return app()->basePath().($path ? DIRECTORY_SEPARATOR.$path : $path);
    }
}

if (! function_exists('event')) {
    /**
     * Dispatch an event and call the listeners.
     *
     * @param null|string|object $event
     * @param array $payload
     * @param bool $halt
     * @return mixed|array|\Nano7\Events\Dispatcher
     */
    function event($event = null, $payload = [], $halt = false)
    {
        if (is_null($event)) {
            return app('events');
        }

        return app('events')->fire($event, $payload, $halt);
    }
}

if (! function_exists('config')) {
    /**
     * Get / set the specified configuration value.
     *
     * If an array is passed as the key, we will assume you want to set an array of values.
     *
     * @param  array|string  $key
     * @param  mixed  $default
     * @return mixed|\Nano7\Config\Repository
     */
    function config($key = null, $default = null)
    {
        if (is_null($key)) {
            return app('config');
        }

        if (is_array($key)) {
            return app('config')->set($key);
        }

        return app('config')->get($key, $default);
    }
}

if (! function_exists('app_path')) {
    /**
     * Get the application path.
     *
     * @param  string  $path
     * @return string
     */
    function app_path($path = '')
    {
        return app()->make('path.app') . ($path ? DIRECTORY_SEPARATOR . $path : $path);
    }
}

if (! function_exists('config_path')) {
    /**
     * Get the configuration path.
     *
     * @param  string  $path
     * @return string
     */
    function config_path($path = '')
    {
        return app()->make('path.config') . ($path ? DIRECTORY_SEPARATOR . $path : $path);
    }
}

if (! function_exists('theme_path')) {
    /**
     * Get the theme path.
     *
     * @param  string  $path
     * @return string
     */
    function theme_path($path = '')
    {
        return app()->make('path.theme') . ($path ? DIRECTORY_SEPARATOR . $path : $path);
    }
}

if (! function_exists('temp_path')) {
    /**
     * Get the temp path.
     *
     * @param  string  $path
     * @return string
     */
    function temp_path($path = '')
    {
        return app()->make('path.temp') . ($path ? DIRECTORY_SEPARATOR . $path : $path);
    }
}

if (! function_exists('request')) {
    /**
     * Get an instance of the current request or an input item from the request.
     *
     * @param  string  $key
     * @param  mixed   $default
     * @return \Illuminate\Http\Request|string|array
     */
    function request($key = null, $default = null)
    {
        if (is_null($key)) {
            return app('request');
        }

        return app('request')->input($key, $default);
    }
}

if (! function_exists('response')) {
    /**
     * Return a new response from the application.
     *
     * @param  string  $content
     * @param  int     $status
     * @param  array   $headers
     * @return \Illuminate\Http\Response
     */
    function response($content = '', $status = 200, array $headers = [])
    {
        return new \Illuminate\Http\Response($content, $status, $headers);
    }
}

if (! function_exists('url')) {
    /**
     * Generate a url for the application.
     *
     * @param  string  $path
     * @param  mixed   $parameters
     * @param  bool    $secure
     * @return \Nano7\Http\UrlGenerator|string
     */
    function url($path = null, $parameters = [], $secure = null)
    {
        if (is_null($path)) {
            return app('url');
        }

        return app('url')->to($path, $parameters, $secure);
    }
}

if (! function_exists('router')) {
    /**
     * @return \Nano7\Http\Routing\Router
     */
    function router()
    {
        return app('router');
    }
}

if (! function_exists('route')) {
    /**
     * @return \Nano7\Http\Routing\Route|null
     */
    function route()
    {
        return router()->current();
    }
}

if (! function_exists('view')) {
    /**
     * Get the evaluated view contents for the given view.
     *
     * @param  string  $view
     * @param  array   $data
     * @param  array   $mergeData
     * @return \Nano7\View\View|\Nano7\View\Factory
     */
    function view($view = null, $data = [], $mergeData = [])
    {
        $factory = app('view');

        if (func_num_args() === 0) {
            return $factory;
        }

        return $factory->make($view, $data, $mergeData);
    }
}

if (! function_exists('db')) {
    /**
     * @param null $connection
     * @return \Nano7\Database\DataManager|\Nano7\Database\ConnectionInterface
     */
    function db($connection = null)
    {
        $db = app('db');

        if (is_null($connection)) {
            return $db;
        }

        return $db->connection($connection);
    }
}

if (! function_exists('trans')) {
    /**
     * @param null $key
     * @param array $replace
     * @param null $locale
     * @return \Illuminate\Translation\Translator|string
     */
    function trans($key = null, array $replace = [], $locale = null)
    {
        $trans = app('translator');

        if (is_null($key)) {
            return $trans;
        }

        return $trans->getFromJson($key, $replace, $locale);
    }
}

if (! function_exists('jargon')) {
    /**
     * @param null $key
     * @param array $replace
     * @param null $locale
     * @return \Illuminate\Translation\Translator|string
     */
    function jargon($key = null, array $replace = [], $locale = null)
    {
        $trans = app('jargon');

        if (is_null($key)) {
            return $trans;
        }

        return $trans->getFromJson($key, $replace, $locale);
    }
}