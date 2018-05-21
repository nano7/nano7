<?php namespace Nano7\Http;

use Nano7\Application;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Filesystem\Filesystem;
use Nano7\Http\Routing\Router;

class Kernel
{
    /**
     * @var Application
     */
    protected $app;

    /**
     * @var Filesystem
     */
    protected $files;

    /**
     * @var Middlewares
     */
    protected $middlewares;

    /**
     * @param Application $app
     */
    public function __construct(Application $app)
    {
        $this->app = $app;
        $this->middlewares = new Middlewares();
        $this->files = $this->app['files'];
    }

    /**
     * Handle web.
     */
    public function handle()
    {
        try {
            // Set running mode
            $this->app->instance('mode', 'web');

            // App boot
            $this->app->boot();

            // Prepare request
            $request = $this->prepareRequest();

            // Preparar rotas
            return $this->runRoute($request);

        } catch (\Exception $e) {
            return Router::toResponse($request, sprintf('error: %s', $e->getMessage()));
        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse|Response
     */
    protected function runRoute(Request $request)
    {
        $router = router();

        // Transferir os middlewares
        foreach ($this->middlewares->getAllMiddlewares() as $alias => $middleware) {
            $router->middleware($alias, $middleware);
        }

        // Transferir os alias
        foreach ($this->middlewares->getAlias() as $alias) {
            $router->alias($alias);
        }

        return $router->handle($request);
    }

    /**
     * Prepare request.
     * @return Request
     */
    protected function prepareRequest()
    {
        $request = Request::capture();
        //$request->setSession(session()->driver());
        $request->enableHttpMethodParameterOverride();

        // Ajustar variaveis para o uso das funcoes url, route, redirect, possam levar para a estrutura nova
        //$vars = $request->server->all();
        //$vars['SCRIPT_NAME'] = str_replace('/runner.php', '/', $vars['SCRIPT_NAME']);
        //$vars['REQUEST_URI'] = str_replace('/runner.php', '/', $vars['REQUEST_URI']);
        //$request->server->replace($vars);

        $this->app->instance('request', $request);

        return $request;
    }

    /**
     * @param $alias
     */
    public function alias($alias)
    {
        $this->middlewares->alias($alias);
    }

    /**
     * @param string|\Closure $middleware
     */
    public function middleware($alias, $middleware)
    {
        $this->middlewares->middleware($alias, $middleware);
    }
}