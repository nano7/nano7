<?php namespace Nano7\Database;

use Nano7\Database\Query\Builder;

interface ConnectionInterface
{
    /**
     * Get collection by name.
     *
     * @param $name
     * @return Builder
     */
    public function collection($name);

    /**
     * Run a select statement and return a single result.
     *
     * @param  string  $collection
     * @param  array   $bindings
     * @return mixed
     */
    //public function findOne($collection, $bindings = []);

    /**
     * Run a select statement against the database.
     *
     * @param  string  $collection
     * @param  array   $bindings
     * @return array
     */
    //public function find($collection, $bindings = []);

    /**
     * Run an insert statement against the database.
     *
     * @param  string  $collection
     * @param  array   $bindings
     * @return bool
     */
    public function insert($collection, $bindings = []);
}