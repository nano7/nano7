<?php namespace Nano7\Http\Routing;

use Illuminate\Support\Arr;
use Illuminate\Http\Request;

class Route
{
    protected $methods = [];

    /**
     * @var string
     */
    protected $uri = '';

    /**
     * @var \Closure
     */
    protected $action;

    /**
     * @var array
     */
    protected $params = [];

    /**
     * @var array
     */
    protected $middlewares = [];

    /**
     * @param $action
     * @param $params
     */
    public function __construct($methods, $uri, $action)
    {
        $this->methods = $methods;
        $this->uri     = $uri;
        $this->action  = $action;
        $this->params  = [];
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function run(Request $request)
    {
        $action = $this->action;

        return $action($request, $this->params);
    }

    /**
     * @param $key
     * @param null $default
     * @return mixed
     */
    public function param($key, $default = null)
    {
        return Arr::get($this->params, $key, $default);
    }

    /**
     * @param $params
     */
    public function setParams($params)
    {
        $this->params = $params;
    }

    /**
     * @return string
     */
    public function getUri()
    {
        return $this->uri;
    }

    /**
     * @return array
     */
    public function getMethods()
    {
        return $this->methods;
    }

    /**
     * @param null $middleware
     * @return $this|array
     */
    public function middlewares($middleware = null)
    {
        if (is_null($middleware)) {
            return $this->middlewares;
        }

        $this->middlewares[] = $middleware;

        return $this;
    }

    /**
     * @param $middleware
     * @return $this
     */
    public function middleware($middleware)
    {
        return $this->middlewares($middleware);
    }
}