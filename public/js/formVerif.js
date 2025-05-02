document.addEventListener("DOMContentLoaded", () => {
    document.querySelectorAll(".generic-form").forEach(form => {
        form.addEventListener("submit", (e) => {
            e.preventDefault();
            let isValid = true;

            form.querySelectorAll(".error-message-contact").forEach(error => error.textContent = "");
            const validMessage = form.querySelector(".valid-message-contact");
            const loadingContainer = document.querySelector(".loading-container");
            validMessage.textContent = "";

            form.querySelectorAll(".form-input-contact").forEach(input => {
                const errorSpan = input.nextElementSibling;

                if (!input.value.trim()) {
                    errorSpan.textContent = `Le champ ${input.name} est requis.`;
                    isValid = false;
                } else if (input.name === "email" && !input.value.match(/^[\w.-]+@[\w.-]+\.\w{2,}$/)) {
                    errorSpan.textContent = "Veuillez entrer un email valide.";
                    isValid = false;
                }
            });

            if (isValid) {
                loadingContainer.style.display = "flex";

                const formData = new FormData(form);
                const url = 'index.php?controller=Contact&action=contactUtilisateur';

                fetch(url, {
                    method: 'POST',
                    body: formData
                })
                    .then(response => response.json())
                    .then(data => {
                        loadingContainer.style.display = "none";
                        if (data.status === 'success') {
                            validMessage.textContent = data.message;
                            validMessage.style.color = "green";
                            form.reset();
                        } else {
                            validMessage.textContent = data.message;
                            validMessage.style.color = "red";
                        }
                    })
                    .catch(error => {
                        loadingContainer.style.display = "none";
                        validMessage.textContent = "Une erreur est survenue lors de l'envoi du formulaire.";
                        validMessage.style.color = "red";
                        console.error("Erreur AJAX:", error);
                    });
            }
        });
    });
});
