<?php

use Core\Database\Connection;

class User
{
    private $db;

    public function __construct()
    {
        $this->db = new Connection();
    }



    public function getAll()
    {
        $users = $this->db->query('SELECT * FROM users');
        return $users;
    }

    public function getById($id)
    {
        $user = $this->db->query('SELECT * FROM users WHERE id = :id', ['id' => $id]);
        return $user;
    }


    public function create($data)
    {
        $this->db->query('INSERT INTO users (name, email, password) VALUES (:name, :email, :password)', $data);

        return $this->db->lastInsertId();
    }

    public function update($id, $data)
    {
        $db = new Connection();
        $db->query('UPDATE users SET name = :name, email = :email, password = :password WHERE id = :id', $data);
    }

    public function delete($id)
    {
        $db = new Connection();
        $db->query('DELETE FROM users WHERE id = :id', ['id' => $id]);
    }

}