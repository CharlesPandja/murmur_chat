<?php
require '../models/Database.php';
require '../models/User.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $database = new Database();
    $user = new User($database);

    $username = $_POST['username'];
    $pseudo = $_POST['pseudo'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    if ($password === $confirm_password) {
        if ($user->register($username, $pseudo, $password)) {
            header('Location: ../index.html');
            exit();
        } else {
            echo "Erreur lors de l'inscription.";
        }
    } else {
        echo "Les mots de passe ne correspondent pas.";
    }
}
?>