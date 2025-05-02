document.getElementById('createCarForm').addEventListener('submit', function(event) {
    event.preventDefault();
    const loadingContainer = document.querySelector(".loading-container");
    const formData = new FormData(this);

    loadingContainer.style.display = "flex";

    fetch('index.php?controller=Admin&action=createCar', {
        method: 'POST',
        body: formData,
    })

    .then(response => response.json())
    .then(data => {
        loadingContainer.style.display = "none";
        if (data.success) {
            document.getElementById('statusMessage').textContent = "Véhicule ajouté avec succès!";
            formData.reset();
        } else {
            document.getElementById('statusMessage').textContent = "Erreur lors de l'ajout du véhicule.";
        }
    })
    .catch(error => {
        loadingContainer.style.display = "none";
        document.getElementById('statusMessage').textContent = "Erreur de connexion. Veuillez réessayer.";
        console.error("Erreur AJAX:", error);
    });
});
