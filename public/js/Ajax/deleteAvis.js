document.querySelectorAll('.supprimer').forEach(function (button) {
    button.addEventListener('click', function (event) {
        event.preventDefault();

        const idAvis = this.dataset.idAvis;
        const idUtilisateur = this.dataset.idUtilisateur;
        const csrf_token = this.dataset.csrf_token;

        let url;
        let data;

        if (idUtilisateur) {
            url = 'index.php?controller=Avis&action=delete&id_utilisateur=' + idUtilisateur + '&id_avis=' + idAvis;
            data = new FormData();
            data.append('id_utilisateur', idUtilisateur);
            data.append('id_avis', idAvis);
            data.append('csrf_token', csrf_token);
        } else if (idAvis) {
            url = 'index.php?controller=Avis&action=delete&id_avis=' + idAvis;
            data = new FormData();
            data.append('id_avis', idAvis);
            data.append('csrf_token', csrf_token);
        }

        fetch(url, {
            method: 'POST',
            body: data
        })
            .then(response => response.json())
            .then(responseData => {
                const messageContainer = document.getElementById('messageContainer'); // Récupère la div où afficher le message
                if (responseData.status === 'success') {
                    messageContainer.innerHTML = `<p style="color: green;">${responseData.message}</p>`;

                    const avisItem = button.closest('.avis-item');
                    if (avisItem) {
                        avisItem.remove();
                    } else {
                        console.log('avisItem introuvable, rechargement de la page...');
                        window.location.reload();
                    }
                } else {
                    messageContainer.innerHTML = `<p style="color: red;">${responseData.message}</p>`;
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Une erreur est survenue.');
            });
    });
});
