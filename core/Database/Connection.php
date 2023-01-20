<?php

namespace Core\Database;
class Connection
{
    private $host = 'localhost';

    private $user = 'root';

    private $password = '';

    private $dbname = 'test';

    private $charset = 'utf8';

    private $conn;

    public function __construct()
    {
        $this->connect();
    }

    public function connect()
    {
        $this->conn = null;

        try {
            $this->conn = new PDO('mysql:host=' . $this->host . ';dbname=' . $this->dbname, $this->user, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            throw new Exception('Connection error: ' . $e->getMessage());
        }

        return $this->conn;
    }

    public function query($sql, $data = [])
    {
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute($data);
        return $stmt;
    }


    public function lastInsertId()
    {
        return $this->connect()->lastInsertId();
    }

}

