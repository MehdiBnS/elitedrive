document.addEventListener("DOMContentLoaded", () => {
    document.querySelectorAll(".generic-form").forEach(form => {
        form.addEventListener("submit", (e) => {
            e.preventDefault();
            let isValid = true;

            form.querySelectorAll(".error-message-contact").forEach(error => error.textContent = "");
  
            form.querySelector(".valid-message-contact").textContent = "";

            form.querySelectorAll(".form-input-contact").forEach(input => {
                const errorSpan = input.nextElementSibling; // cibler les span se trouvant juste après les input 


                if (!input.value.trim()) {
                    errorSpan.textContent = `Le champ ${input.name} est requis.`;
                    isValid = false;
                } 

                else if (input.name === "email" && !input.value.match(/^[\w.-]+@[\w.-]+\.\w{2,}$/)) {
                    errorSpan.textContent = "Veuillez entrer un email valide.";
                    isValid = false;
                }
            });

            if (isValid) {
                form.querySelector(".valid-message-contact").textContent = "Nous avons bien reçu votre message";
                form.reset(); // Réinitialiser les valeurs d'un formulaire
            }
        });
    });
});
