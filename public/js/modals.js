// Récupérer les éléments nécessaires
const modals = document.querySelectorAll(".modal");
const openModalButtons = document.querySelectorAll(".openModalBtn");
const closeModalButtons = document.querySelectorAll(".close");


// Ouvrir la modal lorsque le bouton est cliqué
openModalButtons.forEach(button => {
    button.addEventListener("click", function () {
        const modal = button.nextElementSibling; // La modal juste après le bouton
        modal.style.display = "block"; // Afficher la modal
    });
});

// Fermer la modal lorsque l'utilisateur clique sur le bouton de fermeture
closeModalButtons.forEach(button => {
    button.addEventListener("click", function () {
        const modal = button.closest(".modal"); // Trouver la modal parente du bouton de fermeture
        modal.style.display = "none"; // Cacher la modal
    });
});

// Fermer la modal si l'utilisateur clique à l'extérieur de la modal
window.addEventListener("click", function (event) {
    modals.forEach(modal => {
        if (event.target === modal) {
            modal.style.display = "none"; // Cacher la modal si l'utilisateur clique en dehors
        }
    });
});
