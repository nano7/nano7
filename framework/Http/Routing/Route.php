<?php namespace Nano7\Http\Routing;

use Illuminate\Http\Request;

class Route
{
    /**
     * @var \Closure
     */
    protected $action;

    /**
     * @var array
     */
    protected $params = [];

    /**
     * @param $action
     * @param $params
     */
    public function __construct($action, $params)
    {
        $this->action = $action;
        $this->params = $params;
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
}