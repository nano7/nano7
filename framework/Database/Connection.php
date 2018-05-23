<?php namespace Nano7\Database;

use MongoDB\Client;
use MongoDB\Database;
use Illuminate\Support\Arr;
use Nano7\Database\Query\Builder;

class Connection implements ConnectionInterface
{
    /**
     * The MongoDB database handler.
     *
     * @var Database
     */
    protected $db;

    /**
     * The MongoDB connection handler.
     *
     * @var Client
     */
    protected $client;

    /**
     * @var array
     */
    protected $config = [];

    /**
     * Create a new database connection instance.
     *
     * @param  array $config
     */
    public function __construct(array $config)
    {
        $this->config = $config;

        // Build the connection string
        $dsn = $this->getDsn($config);

        // You can pass options directly to the MongoDB constructor
        $options = Arr::get($config, 'options', []);

        // Create the connection
        $this->connection = $this->createClient($dsn, $config, $options);

        // Select database
        $this->db = $this->connection->selectDatabase($config['database']);
    }

    /**
     * Get collection by name.
     *
     * @param $name
     * @return Builder
     */
    public function collection($name)
    {
        $builder = new Builder($this, $name, $this->db->selectCollection($name));

        return $builder;
    }

    /**
     * Create new collection.
     *
     * @param $name
     * @param array $options
     */
    public function createCollection($name, $options = [])
    {
        $this->db->createCollection($name, $options);
    }

    /**
     * Drop a collection.
     *
     * @param $name
     * @param array $options
     */
    public function dropCollection($name, $options = [])
    {
        $this->db->dropCollection($name, $options);
    }

    /**
     * Create new index.
     *
     * @param $collection
     * @param $key
     * @param array $options
     * @return string
     */
    public function createIndex($collection, $key, array $options = [])
    {
        $col = $this->db->selectCollection($collection);

        return $col->createIndex($key, $options);
    }

    /**
     * Drop a index.
     *
     * @param $collection
     * @param $indexName
     * @param array $options
     * @return array|object
     */
    public function dropIndex($collection, $indexName, array $options = [])
    {
        $col = $this->db->selectCollection($collection);

        return $col->dropIndex($indexName, $options);
    }

    /**
     * Run an insert statement against the database.
     *
     * @param  string $collection
     * @param  array $bindings
     * @return null|string
     */
    public function insert($collection, $bindings = [])
    {
        return $this->collection($collection)->insertGetId($bindings);
    }

    /**
     * @inheritdoc
     */
    public function disconnect()
    {
        unset($this->client);
    }

    /**
     * Create a new MongoDB client connection.
     *
     * @param  string $dsn
     * @param  array $config
     * @param  array $options
     * @return Client
     */
    protected function createClient($dsn, array $config, array $options)
    {
        // By default driver options is an empty array.
        $driverOptions = [];

        if (isset($config['driver_options']) && is_array($config['driver_options'])) {
            $driverOptions = $config['driver_options'];
        }

        // Check if the credentials are not already set in the options
        if (!isset($options['username']) && !empty($config['username'])) {
            $options['username'] = $config['username'];
        }
        if (!isset($options['password']) && !empty($config['password'])) {
            $options['password'] = $config['password'];
        }

        return new Client($dsn, $options, $driverOptions);
    }

    /**
     * Create a DSN string from a configuration.
     *
     * @param  array $config
     * @return string
     */
    protected function getDsn(array $config)
    {
        return $this->hasDsnString($config) ? $this->getDsnString($config) : $this->getHostDsn($config);
    }

    /**
     * Determine if the given configuration array has a dsn string.
     *
     * @param  array  $config
     * @return bool
     */
    protected function hasDsnString(array $config)
    {
        return isset($config['dsn']) && ! empty($config['dsn']);
    }

    /**
     * Get the DSN string form configuration.
     *
     * @param  array  $config
     * @return string
     */
    protected function getDsnString(array $config)
    {
        return $config['dsn'];
    }

    /**
     * Get the DSN string for a host / port configuration.
     *
     * @param  array  $config
     * @return string
     */
    protected function getHostDsn(array $config)
    {
        // Treat host option as array of hosts
        $hosts = is_array($config['host']) ? $config['host'] : [$config['host']];

        foreach ($hosts as &$host) {
            // Check if we need to add a port to the host
            if (strpos($host, ':') === false && !empty($config['port'])) {
                $host = $host . ':' . $config['port'];
            }
        }

        // Check if we want to authenticate against a specific database.
        $auth_database = isset($config['options']) && !empty($config['options']['database']) ? $config['options']['database'] : null;

        return 'mongodb://' . implode(',', $hosts) . ($auth_database ? '/' . $auth_database : '');
    }
}