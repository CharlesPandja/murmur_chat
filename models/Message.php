<?php

class Message {
    private $pdo;

    public function __construct(Database $database) {
        $this->pdo = $database->getConnection();
    }

    public function sendMessage($user_id, $message) {
        $stmt = $this->pdo->prepare("INSERT INTO messages (user_id, message) VALUES (?, ?)");
        return $stmt->execute([$user_id, $message]);
    }

    public function getMessages() {
        $stmt = $this->pdo->query("SELECT messages.message, users.pseudo, messages.created_at 
                                    FROM messages 
                                    JOIN users ON messages.user_id = users.id 
                                    ORDER BY messages.created_at DESC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>