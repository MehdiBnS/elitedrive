document.addEventListener('DOMContentLoaded', function () {
    
    
    const openBtn = document.getElementById('filter-menu');
    const closeBtn = document.getElementById('filter-none');
    const filterContainer = document.getElementById('container-filter');

    // Ouvrir le formulaire
    openBtn.addEventListener('click', function (event) {
        event.preventDefault();
        filterContainer.classList.add('active');
        openBtn.style.display = 'none';
    });

    // Fermer le formulaire
    closeBtn.addEventListener('click', function (event) {
        event.preventDefault();
        filterContainer.classList.remove('active');
        openBtn.style.display = 'block';
    });
});
