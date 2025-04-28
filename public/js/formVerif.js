document.addEventListener("DOMContentLoaded", () => {
    document.querySelectorAll(".generic-form").forEach(form => {
        form.addEventListener("submit", (e) => {
            e.preventDefault();
            let isValid = true;

            // Reset all error messages
            form.querySelectorAll(".error-message-contact").forEach(error => error.textContent = "");
            const validMessage = form.querySelector(".valid-message-contact");
            validMessage.textContent = "";

            // Loop through each form input to validate
            form.querySelectorAll(".form-input-contact").forEach(input => {
                const errorSpan = input.nextElementSibling; // Get the next span (error message)

                if (!input.value.trim()) {
                    errorSpan.textContent = `Le champ ${input.name} est requis.`;
                    isValid = false;
                } else if (input.name === "email" && !input.value.match(/^[\w.-]+@[\w.-]+\.\w{2,}$/)) {
                    errorSpan.textContent = "Veuillez entrer un email valide.";
                    isValid = false;
                }
            });

            // If the form is valid, send it via fetch
            if (isValid) {
                const formData = new FormData(form);

                // Define the URL to send the request to
                const url = 'index.php?controller=Contact&action=contactUtilisateur';

                // Send the form data via AJAX using fetch
                fetch(url, {
                    method: 'POST',
                    body: formData // FormData will include all form fields
                })
                    .then(response => response.json()) // Parse the JSON response
                    .then(data => {
                        if (data.status === 'success') {
                            validMessage.textContent = data.message; // Display success message
                            validMessage.style.color = "green";
                            form.reset(); // Reset form fields after successful submission
                        } else {
                            validMessage.textContent = data.message; // Display error message
                            validMessage.style.color = "red";
                        }
                    })
                    .catch(error => {
                        validMessage.textContent = "Une erreur est survenue lors de l'envoi du formulaire.";
                        validMessage.style.color = "red";
                        console.error("Erreur AJAX:", error);
                    });
            }
        });
    });
});
