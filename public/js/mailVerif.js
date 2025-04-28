const form = document.getElementsByClassName('subscribe-form')[0];
const emailInput = form.getElementsByClassName('email-input')[0];
const errorMessage = form.getElementsByClassName('error-message-newsletter')[0];

console.log(form, emailInput, errorMessage);

form.addEventListener('submit', function (event) {
    event.preventDefault();

    const emailValue = emailInput.value;
    const emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;

    if (!emailValue || !emailPattern.test(emailValue)) {
        console.log("Email invalide ou vide");
        errorMessage.style.display = 'block';
    } else {
        errorMessage.style.display = 'none'; 
        const formData = new FormData();
        formData.append('email', emailValue);
        fetch('index.php?controller=Contact&action=newsletter', { 
            method: 'POST',
            body: formData,
        })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    alert('Formulaire soumis avec succès !');
                    emailInput.value = ''; 
                } else {
                    alert('Erreur lors de l\'envoi du mail');
                }
            })
            .catch(error => {
                console.error('Erreur:', error);
                alert('Une erreur est survenue lors de la soumission.');
            });
    }
});
