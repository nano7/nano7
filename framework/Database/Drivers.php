<?php namespace Nano7\Database;

use Nano7\Support\Manager;

class Drivers extends Manager
{
    /**
     * Get a driver instance.
     *
     * @param  string  $driver
     * @return ConnectionInterface
     */
    public function driver($driver = null)
    {
        $con = parent::driver($driver);

        if (! ($con instanceof ConnectionInterface)) {
            throw new \Exception("Invalid connection: $driver");
        }

        return $con;
    }

    /**
     * Get the default driver name.
     *
     * @return string
     */
    public function getDefaultDriver()
    {
        return null;
    }
}