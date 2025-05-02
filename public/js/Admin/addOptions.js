document.addEventListener("DOMContentLoaded", function () {
    const loadingContainer = document.querySelector(".loading-container");

    // Fonction utilitaire pour soumettre un formulaire avec feedback visuel
    function handleFormSubmission(formId, url, statusMessageId, listSelector = null) {
        document.getElementById(formId).addEventListener('submit', function(event) {
            event.preventDefault();

            const form = this;
            const formData = new FormData(form);
            const statusMessage = document.getElementById(statusMessageId);

            statusMessage.textContent = "Envoi en cours...";
            loadingContainer.style.display = "flex";

            fetch(url, {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                loadingContainer.style.display = "none";
                if (data.success) {
                    statusMessage.textContent = "Ajouté avec succès!";
                    if (listSelector && data.newOptionName) {
                        document.querySelector(listSelector).innerHTML += `<li>${data.newOptionName}</li>`;
                    }
                    form.reset();
                } else {
                    statusMessage.textContent = data.message || "Erreur lors de l'ajout.";
                }
            })
            .catch(error => {
                loadingContainer.style.display = "none";
                statusMessage.textContent = "Erreur de connexion. Veuillez réessayer.";
                console.error("Erreur AJAX:", error);
            });
        });
    }

    // Appel pour chaque formulaire avec paramètres appropriés
    handleFormSubmission('formCategory', 'index.php?controller=Admin&action=createCategory', 'statusMessageCategory', '#categories-list');
    handleFormSubmission('formModele', 'index.php?controller=Admin&action=createModele', 'statusMessageModele', '#modele-list');
    handleFormSubmission('formMarque', 'index.php?controller=Admin&action=createMarque', 'statusMessageMarque', '#marque-list');
    handleFormSubmission('formCarburant', 'index.php?controller=Admin&action=createCarburant', 'statusMessageCarburant', '#carburant-list');
    handleFormSubmission('formTransmission', 'index.php?controller=Admin&action=createTransmission', 'statusMessageTransmission', '#transmission-list');
    handleFormSubmission('formPlaces', 'index.php?controller=Admin&action=createPlaces', 'statusMessagePlaces', '#place-list');
    handleFormSubmission('formCouleur', 'index.php?controller=Admin&action=createCouleur', 'statusMessageCouleur', '#couleur-list');
    handleFormSubmission('createCarForm', 'index.php?controller=Admin&action=createCar', 'statusMessage');
});
