document.addEventListener('DOMContentLoaded', function () {
    
    
    const openBtn = document.getElementById('filter-menu');
    const closeBtn = document.getElementById('filter-none');
    const filterContainer = document.getElementById('container-filter');
    const vehiculeSection = document.getElementById('car-list');

    // Ouvrir le formulaire
    openBtn.addEventListener('click', function (event) {
        event.preventDefault();
        filterContainer.classList.add('active');
        openBtn.style.display = 'none';
        vehiculeSection.style.filter = 'blur(5px)';

    });

    // Fermer le formulaire
    closeBtn.addEventListener('click', function (event) {
        event.preventDefault();
        filterContainer.classList.remove('active');
        openBtn.style.display = 'block';
        vehiculeSection.style.filter = 'blur(0px)';

    });
});
