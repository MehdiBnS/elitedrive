// Démarre le timeout dès le début pour forcer la disparition après 5s max
const forceHide = setTimeout(() => {
    const loading = document.querySelector('.loading-container');
    if (loading) {
        loading.style.display = 'none';
        console.log('Loading forcé après 5 secondes');
    }
}, 2000);

window.addEventListener('load', function () {
    const loading = document.querySelector('.loading-container');
    if (loading) {
        loading.classList.add('flex');
        console.log('Loading container found and displayed.');

        // Retire le loading après 100ms si la page est déjà prête
        setTimeout(() => {
            loading.style.display = 'none';
            console.log('Loading retiré après load');
            clearTimeout(forceHide); // évite double hide
        }, 100);
    }
});
