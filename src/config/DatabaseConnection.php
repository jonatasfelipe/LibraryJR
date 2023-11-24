<?php

namespace LibraryJr\config;

use PDO;
use PDOException;

class DatabaseConnection
{

    private $pdo;

    public function __construct()
    {
        $host = 'localhost';
        $dbname = 'libraryjr';
        $username = 'root';
        $password = '';

        try {
            $this->pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Erro ao conectar: " . $e->getMessage());
        }
    }

    public function getConnection()
    {
        return $this->pdo;
    }
}
