<?php

namespace Core\Database;
class DBConnection
{
    private $connection;

    private static $instance;

    public function __construct()
    {
        $config = include 'config/database.php';
        switch($config['driver']) {
            case 'mysql':
                $this->connection = new MysqlConnection($config['host'], $config['username'], $config['password'], $config['dbname']);
                break;
            // other cases for other drivers
        }
    }

    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }

        return self::$instance;
    }
    

    public function connect()
    {
        return $this->connection->connect();
    }

    public function query($query)
    {
        return $this->connection->query($query);
    }

    public function close()
    {
        $this->connection->close();
    }

    public function lastInsertId()
    {
        return $this->connection->lastInsertId();
    }
}
