<?php namespace Nano7\Auth;

use Nano7\Config\Repository;
use Nano7\Support\ServiceProvider;

class AuthServiceProviders extends ServiceProvider
{
    /**
     * Register objetos do auth.
     */
    public function register()
    {
        $this->registerLoadModel();

        $this->registerManager();
    }

    /**
     * Registrar manager do auth.
     */
    protected function registerManager()
    {
        $this->app->singleton('auth', function ($app) {
            $config = $app['config'];

            $auth = new AuthManager($app, $config->get('auth.default'));

            $this->registerGuardApi($auth, $config);

            return $auth;
        });
    }

    protected function registerLoadModel()
    {
        $this->app->bind('auth.model', function($app) {

            $model = $app['config']->get('auth.model', '\App\Models\User');

            return $app[$model];
        });
    }

    /**
     * @param AuthManager $auth
     * @param Repository $config
     * @param $model
     */
    protected function registerGuardApi(AuthManager $auth, Repository $config)
    {
        $auth->extend('api', function($app) use ($config) {

            // Provider para carrregar model
            $provider = function($storageKey, $token) use ($app) {
                $query = $app['auth.model']->query();

                return $query->where($storageKey, '=', $token)->first();
            };

            // Guard do token
            return new TokenGuard(
                $app,
                $provider,
                $app['request'],
                $config->get('auth.token.inputKey', 'access_token'),
                $config->get('auth.token.storageKey', 'api_token')
            );
        });
    }
}