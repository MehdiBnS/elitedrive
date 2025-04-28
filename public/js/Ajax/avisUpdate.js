const modal = document.getElementById('modalAvis');
const closeModal = document.querySelector('.close');

// ⭐ Gérer les étoiles dans la modal
document.getElementById('editStars').addEventListener('click', function (e) {
    if (e.target.classList.contains('star')) {
        const value = e.target.getAttribute('data-value');
        document.getElementById('editRate').value = value;

        // Colorier les étoiles
        Array.from(this.children).forEach((star, index) => {
            star.style.color = index < value ? 'darkgoldenrod' : 'grey';
        });
    }
});

// 🧼 Fermer la modal
closeModal.onclick = () => modal.style.display = "none";

// 📦 Ouvrir la modal avec données préremplies
document.querySelectorAll('.modifier').forEach(btn => {
    btn.addEventListener('click', function (e) {
        e.preventDefault();

        // Trouver soit avis-item soit avis-item-profile
        let li = btn.closest('.avis-item') || btn.closest('.avis-item-profile');

        if (!li) {
            console.error('Impossible de trouver .avis-item ou .avis-item-profile');
            return;
        }

        const id_avis = li.getAttribute('data-id-avis');
        const id_utilisateur = li.getAttribute('data-id-utilisateur');
        const id_vehicule = btn.getAttribute('data-id-vehicule');

        let commentaire = '';
        const commentaireElement = li.querySelector('.commentaire-texte'); // tu peux créer un span avec cette classe autour du commentaire
        if (commentaireElement) {
            commentaire = commentaireElement.innerText.trim();
        } else {
            commentaire = (li.innerText.split('Commentaire :')[1] || '').split('Posté le')[0].trim();
        }

        const note = li.querySelectorAll('.bi-star-fill[fill="darkgoldenrod"]').length;

        document.getElementById('editIdAvis').value = id_avis;
        document.getElementById('editIdUtilisateur').value = id_utilisateur;
        document.getElementById('editIdVehicule').value = id_vehicule;
        document.getElementById('editComment').value = commentaire;
        document.getElementById('editRate').value = note;

        // Remplir les étoiles
        const stars = document.querySelectorAll('#editStars .star');
        stars.forEach((star, index) => {
            star.style.color = index < note ? 'darkgoldenrod' : 'grey';
        });

        modal.style.display = "block";
    });
});

// 🧠 Envoi AJAX
document.getElementById('formUpdateAvis').addEventListener('submit', function (e) {
    e.preventDefault();
    const formData = new FormData(this);

    fetch('index.php?controller=Avis&action=update&id_avis=' + formData.get('id_avis') +
        '&id_utilisateur=' + formData.get('id_utilisateur') +
        '&id_vehicule=' + formData.get('id_vehicule'), {
        method: 'POST',
        body: formData
    })
        .then(resp => resp.text())
        .then(response => {
            modal.style.display = "none";
            location.reload(); // ou mettre à jour le DOM si tu veux être un boss
        })
        .catch(error => {
            console.error('Erreur:', error);
        });
});
