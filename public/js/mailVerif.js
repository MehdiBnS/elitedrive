const form = document.getElementsByClassName('subscribe-form')[0];
const emailInput = form.getElementsByClassName('email-input')[0];
const errorMessage = form.getElementsByClassName('error-message-newsletter')[0];

console.log(form, emailInput, errorMessage);

form.addEventListener('submit', function (event) {
    event.preventDefault();

    const emailValue = emailInput.value;
    const emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
    const loadingContainer = document.querySelector(".loading-container");

    if (!emailValue || !emailPattern.test(emailValue)) {
        console.log("Email invalide ou vide");
        errorMessage.style.display = 'block';
    } else {
        loadingContainer.style.display = "flex";
        errorMessage.style.display = 'none'; 
        const formData = new FormData();
        formData.append('email', emailValue);
        fetch('index.php?controller=Contact&action=newsletter', { 
            method: 'POST',
            body: formData,
        })
            .then(response => response.json())
            .then(data => {
                loadingContainer.style.display = "none";
                if (data.status === 'success') {
                    errorMessage.textContent = "Inscription réussie !";
                    errorMessage.style.color = "green";
                    errorMessage.style.display = 'block';
                    emailInput.value = ''; 
                } else {
                    alert('Erreur lors de l\'envoi du mail');
                }
            })
            .catch(error => {
                loadingContainer.style.display = "none";
                console.error('Erreur:', error);
                alert('Une erreur est survenue lors de la soumission.');
            });
    }
});
