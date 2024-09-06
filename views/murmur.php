<?php
session_start();

// Redirige l'utilisateur vers la page de connexion s'il n'est pas connecté
if (!isset($_SESSION['user_id'])) {
    header('Location: ../index.html');
    exit();
}

// Charger les classes nécessaires
require '../models/Database.php';
require '../models/User.php';
require '../models/Message.php';

// Initialisation des objets User et Message
$database = new Database();
$user = new User($database);
$message = new Message($database);

// Récupérer les informations de l'utilisateur connecté
$current_user = $user->getUserById($_SESSION['user_id']);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MurMur Chat</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <div class="home-container">
        <h2>Bienvenue, <?php echo htmlspecialchars($current_user['pseudo']); ?>!</h2>
        <div id="chat-box" style="overflow-y: auto; height: 300px; border: 1px solid #ccc; padding: 10px; margin-bottom: 20px;">
            <!-- Les messages seront chargés ici -->
        </div>
        <form id="message-form">
            <input type="text" id="message" placeholder="Tapez votre message" required style="width: 80%; padding: 10px; border: 1px solid #ccc; border-radius: 5px;">
            <button type="submit" style="width: 18%; padding: 10px; background-color: #917fb3; border: none; border-radius: 5px; color: white; font-size: 16px;">Envoyer</button>
        </form>
    </div>

    <script src="../assets/javascript/messages.js"></script>
</body>
</html>