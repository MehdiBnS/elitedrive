const form = document.getElementsByClassName('subscribe-form')[0];
const emailInput = form.getElementsByClassName('email-input')[0];
const errorMessage = form.getElementsByClassName('error-message-newsletter')[0];

console.log(form, emailInput, errorMessage);

form.addEventListener('submit', function(event) {
    event.preventDefault();

    const emailValue = emailInput.value;
    const emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;

    if (!emailValue || !emailPattern.test(emailValue)) {
        console.log("Email invalide ou vide");
        errorMessage.style.display = 'block';
    } else {
        errorMessage.style.display = 'none';
        alert('Formulaire soumis avec succès !');
        emailInput.value = '';
    }
});
