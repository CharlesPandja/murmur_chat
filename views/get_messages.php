<?php
require '../models/Database.php';
require '../models/Message.php';

$database = new Database();
$message = new Message($database);

$messages = $message->getMessages();

foreach ($messages as $msg) {
    echo "<p><strong>{$msg['pseudo']}:</strong> {$msg['message']} <em>({$msg['created_at']})</em></p>";
}
?>