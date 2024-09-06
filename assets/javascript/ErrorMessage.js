document.addEventListener("DOMContentLoaded", function (){

    const displayErrorName = document.getElementById("displayErrorName");
    const displayErrorPseudo = document.getElementById("displayErrorPseudo");
    const displayErrorPassword = document.getElementById("displayErrorPassword");
    const displayErrorPassword2 = document.getElementById("displayErrorPassword2");
    const username = document.getElementById("username");
    const pseudo = document.getElementById("pseudo");
    const password = document.getElementById("password");
    const confirm_password = document.getElementById("confirm_password");
    const form = document.getElementById("form");

    function showError(element, message, input) {
        element.textContent = message;
        element.classList.add("error-message");
        input.classList.add("input-error");
    }

    function clearError(element, input) {
        element.textContent = "";
        element.classList.remove("error-message");
        input.classList.remove("input-error");
    }

    function removeErrorOnInput(input, errorElement) {
        input.addEventListener("input", function() {
            clearError(errorElement, input);
        });
    }

    removeErrorOnInput(username, displayErrorName);
    removeErrorOnInput(pseudo, displayErrorPseudo);
    removeErrorOnInput(password, displayErrorPassword);
    removeErrorOnInput(confirm_password, displayErrorPassword2);

    form.addEventListener("submit", function(e) {
        let isValid = true;

        if (!/^[a-zA-Z]+$/.test(username.value)) {
            showError(displayErrorName, "Votre nom ne peut contenir que des lettres", username);
            isValid = false;
        }

        if (!/^[a-zA-Z]+$/.test(pseudo.value)) {
            showError(displayErrorPseudo, "Votre pseudo ne peut contenir que des lettres", pseudo);
            isValid = false;
        }

        if (!/^[a-zA-Z0-9]{8,20}$/.test(password.value)) {
            showError(displayErrorPassword, "Votre mot de passe doit contenir entre 8 et 20 caractères", password);
            isValid = false;
        }

        if (password.value !== confirm_password.value) {
            showError(displayErrorPassword2, "Les mots de passe ne correspondent pas", confirm_password);
            isValid = false;
        }

        if (!isValid) {
            e.preventDefault();
        }
    });
});