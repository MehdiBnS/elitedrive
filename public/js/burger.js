// On attend que tout le contenu HTML soit chargé avant d'exécuter le script
document.addEventListener("DOMContentLoaded", function () {

    // Sélection de l'icône du menu burger (visible sur mobile)
    const burgerIcon = document.querySelector(".burger-icon");

    // Sélection de la barre de navigation principale
    const navBar = document.getElementById("navBar");

    // Sélection du menu "Nos locations" qui contient un sous-menu
    const menuNosLocations = document.querySelector("#menuNosLocations");

    // Sélection du sous-menu (liste cachée ou visible au clic)
    const sousMenu = document.querySelector(".sous-menu");

    // Clic sur l'icône burger : on ajoute/enlève la classe "active" pour afficher ou cacher le menu
    burgerIcon.addEventListener("click", function () {
        navBar.classList.toggle("active");
    });

    // Si l’élément "Nos locations" est présent dans le DOM
    if (menuNosLocations) {
        // Clic sur "Nos locations"
        menuNosLocations.addEventListener("click", function (event) {

            // On vérifie si l’élément cliqué a la classe 'lienMenu' (vrai lien)
            const linkClicked = event.target;
            if (linkClicked && linkClicked.classList.contains('lienMenu')) {
                // Si oui, on laisse le comportement normal (redirection)
                return;
            }

            // Sinon, on empêche le lien de s’ouvrir
            event.preventDefault();

            // On alterne l'affichage du sous-menu : visible ↔ caché
            if (sousMenu.style.display === "block") {
                sousMenu.style.display = "none";
            } else {
                sousMenu.style.display = "block";
            }
        });
    }
});
