document.addEventListener('DOMContentLoaded', function() {
    // Charger les messages dès que la page est prête
    loadMessages();

    // Rafraîchir les messages toutes les 2 secondes
    setInterval(loadMessages, 2000);

    // Fonction pour charger les messages
    function loadMessages() {
        fetch('get_messages.php')
            .then(response => {
                if (!response.ok) {
                    throw new Error('Erreur lors du chargement des messages');
                }
                return response.text();
            })
            .then(data => {
                document.getElementById('chat-box').innerHTML = data;
                // Scroll en bas du chat pour afficher le dernier message
                const chatBox = document.getElementById('chat-box');
                chatBox.scrollTop = chatBox.scrollHeight;
            })
            .catch(error => {
                console.error('Erreur :', error);
            });
    }

    // Gestion de l'envoi des messages
    document.getElementById('message-form').addEventListener('submit', function(e) {
        e.preventDefault();
        const message = document.getElementById('message').value.trim();

        if (message !== '') {
            fetch('send_messages.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: new URLSearchParams({
                    message: message
                })
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Erreur lors de l\'envoi du message');
                }
                return response.text();
            })
            .then(data => {
                console.log(data); // Affiche le succès ou l'erreur renvoyée par le serveur
                loadMessages(); // Recharge les messages pour inclure le nouveau message
                document.getElementById('message').value = ''; // Vider le champ de saisie
            })
            .catch(error => {
                console.error('Erreur :', error);
            });
        }
    });
});