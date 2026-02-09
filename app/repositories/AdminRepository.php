<?php

namespace app\repositories;

use PDO;

class AdminRepository
{
    private $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function usernameExist($username)
    {
        $st = $this->pdo->prepare("SELECT 1 FROM admin WHERE username=? LIMIT 1");
        $st->execute([(string)$username]);
        return (bool)$st->fetchColumn();
    }

    public function adminLogin($username, $hash)
    {
        $st = $this->pdo->prepare("SELECT 1 FROM admin WHERE username=? AND password_hash=? LIMIT 1");
        $st->execute([(string)$username, (string)$hash]);
        return (bool)$st->fetchColumn();
    }

    public function create($username , $hash)
    {
        $st = $this->pdo->prepare("INSERT INTO admin(username,password_hash) VALUES(?,?)");
        $st->execute([(string)$username, (string)$hash]);
        return $this->pdo->lastInsertId();
    }

    public function getAll()
    {
        $st = $this->pdo->query("SELECT id,username FROM admin");
        return $st->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById($id)
    {
        $st = $this->pdo->prepare("SELECT id,username FROM admin WHERE id=?");
        $st->execute([(int)$id]);
        return $st->fetch(PDO::FETCH_ASSOC);
    }

    // public function getByUsername($username)
    // {
    //     $st = $this->pdo->prepare("SELECT * FROM admin WHERE username=?");
    //     $st->execute([(string)$username]);
    //     return $st->fetch(PDO::FETCH_ASSOC);
    // }

    public function update($id, $username , $hash)
    {
        $st = $this->pdo->prepare("UPDATE admin SET username=?, password_hash=? WHERE id=?");
        return $st->execute([(string)$username, (string)$hash, (int)$id]);
    }

    // public function delete($id)
    // {
    //     $st = $this->pdo->prepare("DELETE FROM admin WHERE id=?");
    //     return $st->execute([(int)$id]);
    // }
}
