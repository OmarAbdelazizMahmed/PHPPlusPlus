<?php

namespace Core\Database;

use Core\Database\DBConnectionInterface;

class MysqlConnection implements DBConnectionInterface
{
    private $conn;

    public function __construct($host, $username, $password, $dbname)
    {
        $this->conn = new mysqli($host, $username, $password, $dbname);
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }

    public function connect()
    {
        return $this->conn;
    }

    public function query($query)
    {
        return $this->conn->query($query);
    }

    public function close()
    {
        $this->conn->close();
    }
}
