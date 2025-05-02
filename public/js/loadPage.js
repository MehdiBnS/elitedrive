window.addEventListener('load', function() {
    const loading = document.querySelector('.loading-container');
    if (loading) {
        loading.classList.add('flex');
        console.log('Loading container found and displayed.');
        setTimeout(() => loading.style.display = 'none', 100);
    }
});
