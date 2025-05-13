// Initialisation de l’index de l’image actuellement affichée (commence à 0, soit la première image)
let currentIndex = 0;

// Sélection de toutes les balises <img> dans le conteneur du carrousel
const images = document.querySelectorAll('.carousel-images img');

// Calcul du nombre total d’images dans le carrousel
// images.length renvoie le nombre d’éléments <img> sélectionnés
const totalImages = images.length;

// Sélection des boutons "suivant" et "précédent"
const nextButton = document.querySelector('.next');
const prevButton = document.querySelector('.prev');

// Événement lors d’un clic sur le bouton "suivant"
nextButton.addEventListener('click', () => {
    // Si on n'est pas à la dernière image, on avance d'une image
    if (currentIndex < totalImages - 1) {
        currentIndex++;
    } else {
        // Sinon, on revient à la première image
        currentIndex = 0;
    }
    updateCarousel(); // Mise à jour de l'affichage
});

// Événement lors d’un clic sur le bouton "précédent"
prevButton.addEventListener('click', () => {
    // Si on n'est pas à la première image, on recule d'une image
    if (currentIndex > 0) {
        currentIndex--;
    } else {
        // Sinon, on va à la dernière image
        currentIndex = totalImages - 1;
    }
    updateCarousel(); // Mise à jour de l'affichage
});

// Fonction qui met à jour la position des images dans le carrousel
function updateCarousel() {
    // On calcule combien on doit décaler l'affichage vers la gauche
    // Exemple : currentIndex = 1 → translateX(-33%) pour voir la 2e image
    const newTransformValue = `translateX(-${currentIndex * 33}%)`;
    
    // On applique la transformation CSS au conteneur d'images
    document.querySelector('.carousel-images').style.transform = newTransformValue;
}
