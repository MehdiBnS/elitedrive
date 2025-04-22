document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('search-form');

    form.addEventListener('submit', function (event) {
        event.preventDefault();
        
        //Garde les infos après indes.php, tels que controller=..&action=...
        let url = new URL(window.location.href);

        //Donner à une constante les infos qui peuvent être filtrer
        const filters = [
            'search', 'marque', 'modele', 'categorie', 'couleur', 'places',
            'carburant[]', 'transmission[]'
        ];

        //Si le formulaire est envoyer une seconde fois on supprime toutes les options de filtrage qui ont été inclus une premiere fois
        filters.forEach(param => {
            url.searchParams.delete(param);
        });

        // Récupérer les nouvelles valeurs du formulaire
        const searchInput = document.getElementById('search-filter').value;
        const marqueSelect = document.getElementById('marque-filter').value;
        const modeleSelect = document.getElementById('modele-filter').value;
        const categorieSelect = document.getElementById('categorie-filter').value;
        const couleurSelect = document.getElementById('couleur-filter').value;
        const placesSelect = document.getElementById('places-filter').value;

        if (searchInput) url.searchParams.set('search', searchInput);
        if (marqueSelect) url.searchParams.set('marque', marqueSelect);
        if (modeleSelect) url.searchParams.set('modele', modeleSelect);
        if (categorieSelect) url.searchParams.set('categorie', categorieSelect);
        if (couleurSelect) url.searchParams.set('couleur', couleurSelect);
        if (placesSelect) url.searchParams.set('places', placesSelect);

        const carburants = document.querySelectorAll('input[name="carburant[]"]:checked');
        carburants.forEach(carburant => {
            url.searchParams.append('carburant[]', carburant.value);
        });

        const transmissions = document.querySelectorAll('input[name="transmission[]"]:checked');
        transmissions.forEach(transmission => {
            url.searchParams.append('transmission[]', transmission.value);
        });

        // Redirection avec l'URL 
        window.location.href = url.toString();

        // réinitialiser le formulaire
        form.reset();
    });
});
