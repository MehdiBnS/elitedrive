document.addEventListener("DOMContentLoaded", () => {
    const form = document.getElementById("register-form");
    const email = document.getElementById("email");
    const emailError = document.getElementById("email-error");
    const phone = document.getElementById("tel");
    const phoneError = document.getElementById("phone-error");
    const password = document.getElementById("password");
    const passwordRequirements = document.querySelectorAll("#password-requirements .error-message-sub");

    email.addEventListener("focus", () => emailError.style.display = "block");
    phone.addEventListener("focus", () => phoneError.style.display = "block");
    email.addEventListener("input", () => emailError.style.display = "none");
    phone.addEventListener("input", () => phoneError.style.display = "none");

    password.addEventListener("input", () => {
        let pass = password.value;
        passwordRequirements[0].classList.toggle("valid", pass.length >= 8);
        passwordRequirements[1].classList.toggle("valid", /[A-Z]/.test(pass));
        passwordRequirements[2].classList.toggle("valid", /[a-z]/.test(pass));
        passwordRequirements[3].classList.toggle("valid", /\d/.test(pass));
        passwordRequirements[4].classList.toggle("valid", /[@$!%*?&]/.test(pass));
    });

    form.addEventListener("submit", (event) => {
        console.log("Tentative de soumission...");
        let isValid = true;

        if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email.value.trim())) {
            console.log("Email invalide :", email.value);
            emailError.style.display = "block";
            isValid = false;
        }

        if (!/^\d{10}$/.test(phone.value.trim())) {
            console.log("Téléphone invalide :", phone.value);
            phoneError.style.display = "block";
            isValid = false;
        }

        let passwordValid = document.querySelectorAll("#password-requirements .valid").length === 5;
        if (!passwordValid) {
            console.log("Mot de passe invalide :", password.value);
            isValid = false;
        }

        if (!isValid) {
            console.log("Formulaire invalide, envoi annulé.");
            event.preventDefault();
        } else {
            console.log("Formulaire valide, envoi en cours...");
        }
    });
});