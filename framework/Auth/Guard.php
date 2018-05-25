<?php namespace Nano7\Auth;

use Nano7\Application;

abstract class Guard
{
    /**
     * The application instance.
     *
     * @var Application
     */
    protected $app;

    /**
     * @var UserInterface
     */
    protected $user;

    /**
     * @var \Closure
     */
    protected $provider;

    /**
     * @param $app
     * @param \Closure $provider
     */
    public function __construct($app, $provider)
    {
        $this->app = $app;
        $this->provider = $provider;
    }

    /**
     * Retorna usuario logado.
     *
     * @return UserInterface
     */
    public function user()
    {
        // Verificar se ja esta carregado
        if (! is_null($this->user)) {
            return $this->user;
        }

        // Carregar usuario
        return $this->user = $this->retrieve();
    }

    /**
     * Retorna se usuario esta logado.
     *
     * @return bool
     */
    public function check()
    {
        return !is_null($this->user());
    }

    /**
     * Retorna se usuario não esta logado (ANONIMO).
     *
     * @return bool
     */
    public function guest()
    {
        return is_null($this->user());
    }

    /**
     * @return UserInterface
     */
    abstract protected function retrieve();

    /**
     * Carregar user interface.
     *
     * @return null|UserInterface
     */
    public function provider()
    {
        if (is_null($this->provider)) {
            return null;
        }

        return call_user_func_array($this->provider, func_get_args());
    }
}