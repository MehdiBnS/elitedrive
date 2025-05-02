document.addEventListener("DOMContentLoaded", function () {
    document.querySelectorAll('.archive-form').forEach(form => {
        form.addEventListener('submit', function (e) {
            e.preventDefault();

            const formData = new FormData(this);
            const button = this.querySelector('.archive-btn');

            fetch('index.php?controller=Admin&action=createArchive', {
                method: 'POST',
                body: formData
            })
            .then(res => res.text())
            .then(text => {
                console.log("Réponse serveur :", text);

                if (text.includes("Archive créée")) {
                    button.outerHTML = `
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="green" class="bi bi-check-circle-fill" viewBox="0 0 16 16">
                            <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM6.97 11.03a.75.75 0 0 0 1.08.022l3.992-3.992a.75.75 0 0 0-1.06-1.06L7.5 9.439 5.53 7.47a.75.75 0 0 0-1.06 1.06l2.5 2.5z"/>
                        </svg>`;
                } else {
                    alert("Erreur lors de l'archivage.");
                }
            })
            .catch(error => {
                console.error("Erreur AJAX :", error);
                alert("Erreur de connexion.");
            });
        });
    });
});
