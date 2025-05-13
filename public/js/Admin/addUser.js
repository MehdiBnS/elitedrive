document.getElementById('createUserForm').addEventListener('submit', function(event) {
    event.preventDefault();

    const form = this; 
    const formData = new FormData(form);

    document.getElementById('statusMessage').textContent = "Envoi en cours...";

    fetch('index.php?controller=Admin&action=createUser', {
        method: 'POST',
        body: formData,
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            document.getElementById('statusMessage').textContent = "Utilisateur ajouté avec succès!";
            form.reset(); 
        } else {
            document.getElementById('statusMessage').textContent = "Erreur lors de l'ajout de l'utilisateur.";
        }
    })
    .catch(error => {
        document.getElementById('statusMessage').textContent = "Erreur de connexion. Veuillez réessayer.";
        console.error("Erreur AJAX:", error);
    });
});
