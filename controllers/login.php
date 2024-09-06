<?php
session_start();
require '../models/Database.php';
require '../models/User.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $database = new Database();
    $user = new User($database);

    $pseudo = trim($_POST['pseudo']);
    $password = trim($_POST['password']);

    $loggedInUser = $user->login($pseudo, $password);

    // var_dump($loggedInUser);

    if ($loggedInUser) {
        $_SESSION['user_id'] = $loggedInUser['id'];
        $_SESSION['pseudo'] = $loggedInUser['pseudo'];
        header('Location: ../views/murmur.php');
        exit();
    } else {
        echo "Pseudo ou mot de passe incorrect.";
    }
}
?>