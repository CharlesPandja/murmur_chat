<?php

class User
{
    private $pdo;
    public function __construct(Database $database)
    {
        $this->pdo = $database->getConnection();
    }

    public function register($username, $pseudo, $password)
    {
        // $hashed_password = password_hash($password, PASSWORD_BCRYPT);
        $hashed_password = md5($password);
        // $hashed_password = hash('sha256', $password);
        $stmt = $this->pdo->prepare("INSERT INTO users(username, pseudo, password) VALUES (?, ?, ?)");
        return $stmt->execute([$username, $pseudo, $hashed_password]);
    }

    public function login($pseudo, $password)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE pseudo = ?");
        $stmt->execute([$pseudo]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        // echo '<pre>';
        // var_dump($user);
        // echo '</pre>';
        // $hashed_password = password_hash($password, PASSWORD_BCRYPT);
        $hashed_password = md5($password);
        // $hashed_password = hash('sha256', $password);
        // echo $hashed_password;
        // if (password_verify($hashed_password, $user['password'])) {
        //     return true;
        // }
        if ($hashed_password == $user['password']) {
            return $user;
        }

        return false;
    }

    public function getUserById($user_id)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE id = ?");
        $stmt->execute([$user_id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
