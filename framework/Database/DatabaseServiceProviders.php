<?php namespace Nano7\Database;

use Nano7\Database\MongoDb\Connection;
use Nano7\Support\ServiceProvider;

class DatabaseServiceProviders extends ServiceProvider
{
    /**
     * Register objetos base.
     */
    public function register()
    {
        $this->app->singleton('db', function () {
            $manager = new DataManager($this->app, $this->app['config']->get('database', []));

            // Driver Mongo
            $this->registerMongoDb($manager);

            return $manager;
        });
    }

    protected function registerMongoDb(DataManager $manager)
    {
        $manager->extend('mongodb', function($app, $config) {
            return new Connection($config);
        });
    }
}