<?php namespace Nano7\Auth;

use Illuminate\Http\Request;

class RequestGuard extends Guard
{
    /**
     * The guard callback.
     *
     * @var callable
     */
    protected $callback;

    /**
     * The request instance.
     *
     * @var Request
     */
    protected $request;

    /**
     * @param $app
     * @param Request $request
     * @param callable $callback
     */
    public function __construct($app, Request $request, callable $callback)
    {
        parent::__construct($app, $callback);

        $this->callback = $callback;
        $this->request = $request;
    }

    /**
     * @return UserInterface|null
     */
    protected function retrieve()
    {
        return $this->provider($this->app, $this->request);
    }
}