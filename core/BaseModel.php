<?php

namespace Core;

use Core\Database\DBConnection;

abstract class BaseModel {
    protected $db;
    protected $table;
    public function __construct() {
        $this->db = DBConnection::getInstance()->connect();
        $class = str_replace('Model', '', get_called_class());
        $this->table = strtolower(substr($class, 0, -1)) . 's';
    }

    public function all()
    {
        return $this->db->query("SELECT * FROM {$this->table}");
    }

    public function find($id)
    {
        return $this->db->query("SELECT * FROM {$this->table} WHERE id = :id", ['id' => $id]);
    }

    public function create($data)
    {
        $this->db->query("INSERT INTO {$this->table} (name, email, password) VALUES (:name, :email, :password)", $data);

        return $this->db->lastInsertId();
    }


    public function update($id, $data)
    {
        $this->db->query("UPDATE {$this->table} SET name = :name, email = :email, password = :password WHERE id = :id", $data);
    }


    public function delete($id)
    {
        $this->db->query("DELETE FROM {$this->table} WHERE id = :id", ['id' => $id]);
    }

    public static function __callStatic($method, $args)
    {
        $instance = new static;
        return call_user_func_array([$instance, $method], $args);
    }
}