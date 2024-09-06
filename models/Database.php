<?php

class Database {
    private $host = '127.0.0.1';
    private $db = 'murmur_chat';
    private $user = 'root';
    private $pass = '';
    private $pdo;

    public function __construct() {
        $dsn = "mysql:host=$this->host;dbname=$this->db";

        try {
            $this->pdo = new PDO($dsn, $this->user, $this->pass);
        } catch (PDOException $e) {
            throw new Exception('Echec de la connexion : ' . $e->getMessage());
        }
    }

    public function getConnection() {
        return $this->pdo;
    }
}
?>