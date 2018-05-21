<?php namespace Nano7\Http\Routing;

use FastRoute\RouteCollector;

class RouteCollection
{
    /**
     * @var RouteCollector
     */
    protected $collector;

    /**
     * @param RouteCollector $collector
     */
    public function __construct(RouteCollector $collector)
    {
        $this->collector = $collector;
    }

    /**
     * Adds a GET route to the collection
     *
     * This is simply an alias of $this->addRoute(['GET','HEAD'], $route, $handler)
     *
     * @param string $route
     * @param mixed  $handler
     */
    public function get($route, $handler)
    {
        $this->collector->addRoute(['GET','HEAD'], $route, $handler);
    }

    /**
     * Adds a POST route to the collection
     *
     * This is simply an alias of $this->addRoute('POST', $route, $handler)
     *
     * @param string $route
     * @param mixed  $handler
     */
    public function post($route, $handler)
    {
        $this->collector->addRoute('POST', $route, $handler);
    }

    /**
     * Adds a PUT route to the collection
     *
     * This is simply an alias of $this->addRoute('PUT', $route, $handler)
     *
     * @param string $route
     * @param mixed  $handler
     */
    public function put($route, $handler)
    {
        $this->collector->addRoute('PUT', $route, $handler);
    }

    /**
     * Adds a DELETE route to the collection
     *
     * This is simply an alias of $this->addRoute('DELETE', $route, $handler)
     *
     * @param string $route
     * @param mixed  $handler
     */
    public function delete($route, $handler)
    {
        $this->collector->addRoute('DELETE', $route, $handler);
    }

    /**
     * Adds a GET route to the collection
     *
     * This is simply an alias of $this->addRoute('*', $route, $handler)
     *
     * @param string $route
     * @param mixed  $handler
     */
    public function any($route, $handler)
    {
        $this->collector->addRoute(['GET', 'HEAD', 'POST', 'PUT', 'PATCH', 'DELETE', 'OPTIONS'], $route, $handler);
    }

    /**
     * @param $prefix
     * @param callable $callback
     */
    public function group($prefix, callable $callback)
    {
        $this->collector->addGroup($prefix, function($collector) use ($callback) {
            $callback(new RouteCollection($collector));
        });
    }

    /**
     * @param $name
     * @param $arguments
     * @return mixed
     */
    //public function __call($name, $arguments)
    //{
    //    return call_user_func_array([$this->collector, $name], $arguments);
    //}
}