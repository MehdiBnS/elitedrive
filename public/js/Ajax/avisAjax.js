document.getElementById('avisForm').addEventListener('submit', function (e) {
    e.preventDefault();

    const rate = parseInt(document.getElementById('rate').value);
    const comment = document.getElementById('comment').value;
    const idVehicule = new URLSearchParams(window.location.search).get("id_vehicule");

    if (!idVehicule) {
        console.error('ID véhicule introuvable dans l\'URL');
        return;
    }

    const data = {
        rate: rate,
        comment: comment
    };

    const url = `index.php?controller=Avis&action=create&id_vehicule=${idVehicule}`;

    fetch(url, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(data)
    })
        .then(res => res.json())
        .then(data => {
            if (data.success) {
                document.getElementById('avisForm').reset();
                const avisContainer = document.getElementById('avisContainer');
                const newAvis = document.createElement('li');
                const stars = generateStars(data.note);

                newAvis.innerHTML = `<h2>Votre avis est bien ajouté ! :</h2><br><strong>${data.nom_utilisateur} ${data.prenom_utilisateur}</strong>: ${stars} ${data.commentaire ? data.commentaire : 'Avis sans message'} `;
                newAvis.style.listStyle = 'none'
                avisContainer.appendChild(newAvis);
            } else if (data.redirect) {
                window.location.href = data.redirect;
            } else {
                alert(data.message);
            }
        })
        .catch(error => {
            console.error('Erreur AJAX:', error);
        });
});
function generateStars(rating) {
    let starsHtml = '';
    for (let i = 1; i <= 5; i++) {
        if (i <= rating) {
            starsHtml += '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="darkgoldenrod" class="bi bi-star-fill" viewBox="0 0 16 16"><path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z" /></svg>';
        } else {
            starsHtml += '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="white" class="bi bi-star-fill" viewBox="0 0 16 16"><path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z" /></svg>';
        }
    }
    return starsHtml;
}


document.querySelectorAll('.supprimer').forEach(function (button) {
    button.addEventListener('click', function (event) {
        event.preventDefault();

        const idAvis = this.dataset.idAvis;
        const idUtilisateur = this.dataset.idUtilisateur;

        let url;
        let data;

        if (idUtilisateur) {
            url = 'index.php?controller=Avis&action=delete&id_utilisateur=' + idUtilisateur + '&id_avis=' + idAvis;
            data = new FormData();
            data.append('id_utilisateur', idUtilisateur);
            data.append('id_avis', idAvis);
        } else if (idAvis) {
            url = 'index.php?controller=Avis&action=delete&id_avis=' + idAvis;
            data = new FormData();
            data.append('id_avis', idAvis);
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
                    avisItem.remove();
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


