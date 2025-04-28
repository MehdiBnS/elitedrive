document.addEventListener("DOMContentLoaded", () => {
    const registerForm = document.getElementById("register-form");
    const updateForm = document.getElementById("update-form");
    const resetPassword = document.getElementById("reset-password-form");

    const email = document.getElementById("email");
    const emailError = document.getElementById("email-error");
    const phone = document.getElementById("tel");
    const phoneError = document.getElementById("phone-error");
    const password = document.getElementById("password");
    const passwordRequirements = document.querySelectorAll("#password-requirements .error-message-sub");

    if (email && emailError) {
        email.addEventListener("focus", () => emailError.style.display = "block");
        email.addEventListener("input", () => emailError.style.display = "none");
    }

    if (phone && phoneError) {
        phone.addEventListener("focus", () => phoneError.style.display = "block");
        phone.addEventListener("input", () => phoneError.style.display = "none");
    }

    if (password && passwordRequirements.length === 5) {
        password.addEventListener("input", () => {
            let pass = password.value;
            passwordRequirements[0].classList.toggle("valid", pass.length >= 8);
            passwordRequirements[1].classList.toggle("valid", /[A-Z]/.test(pass));
            passwordRequirements[2].classList.toggle("valid", /[a-z]/.test(pass));
            passwordRequirements[3].classList.toggle("valid", /\d/.test(pass));
            passwordRequirements[4].classList.toggle("valid", /[@$!%*?&]/.test(pass));
        });
    }

    const validateForm = (form) => {
        form.addEventListener("submit", (event) => {
            console.log("Tentative de soumission...");
            let isValid = true;

            if (email && !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email.value.trim())) {
                console.log("Email invalide :", email.value);
                emailError.style.display = "block";
                isValid = false;
            }

            if (phone && !/^\d{10}$/.test(phone.value.trim())) {
                console.log("Téléphone invalide :", phone.value);
                phoneError.style.display = "block";
                isValid = false;
            }

            if (password && document.querySelectorAll("#password-requirements .valid").length !== 5) {
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
    };

    if (registerForm) validateForm(registerForm);
    if (updateForm) validateForm(updateForm);
    if (resetPassword) validateForm(resetPassword);
});
