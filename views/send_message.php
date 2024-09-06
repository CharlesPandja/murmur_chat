<?php
session_start();
require '../models/Database.php';
require '../models/Message.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $database = new Database();
    $message = new Message($database);

    $messageContent = $_POST['message'];
    $user_id = $_SESSION['user_id'];

    if ($message->sendMessage($user_id, $messageContent)) {
        echo "Message envoyé avec succès.";
    } else {
        echo "Erreur lors de l'envoi du message.";
    }
}
?>