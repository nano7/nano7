<?php namespace Nano7\Database;

interface ConnectionInterface
{
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

    /**
     * Run an update statement against the database.
     *
     * @param  string  $collection
     * @param  array   $bindings
     * @return int
     */
    //public function update($collection, $bindings = []);

    /**
     * Run a delete statement against the database.
     *
     * @param  string  $collection
     * @param  array   $bindings
     * @return int
     */
    //public function delete($collection, $bindings = []);
}