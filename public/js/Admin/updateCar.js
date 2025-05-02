document.addEventListener("DOMContentLoaded", () => {
    const modalUpdate = document.querySelector(".modalUpdate");
    const closeUpdateBtn = document.querySelector(".closeUpdate");

    function openUpdateModal(vehicule, options) {
        modalUpdate.style.display = "flex";

        modalUpdate.querySelector("#id_vehicule").value = vehicule.id_vehicule || "";
        modalUpdate.querySelector("#nom").value = vehicule.nom || "";
        modalUpdate.querySelector("#prix_km").value = vehicule.prix_km || "";
        modalUpdate.querySelector("#prix_jour").value = vehicule.prix_jour || "";
        modalUpdate.querySelector("#prix_semaine").value = vehicule.prix_semaine || "";
        modalUpdate.querySelector("#prix_mois").value = vehicule.prix_mois || "";
        modalUpdate.querySelector("#annee").value = vehicule.annee || "";
        modalUpdate.querySelector("#description").value = vehicule.description || "";
        modalUpdate.querySelector("#statut").value = vehicule.statut || "Disponible";

        function populateSelect(id, data, key, selectedId) {
            const select = modalUpdate.querySelector(`#${id}`);
            select.innerHTML = "";
            data.forEach(item => {
                const option = document.createElement("option");
                option.value = item[id];
                option.textContent = item[key];
                if (item[id] == selectedId) option.selected = true;
                select.appendChild(option);
            });
        }

        populateSelect("id_modele", options.modeles, "nom", vehicule.id_modele);
        populateSelect("id_marque", options.marques, "nom", vehicule.id_marque);
        populateSelect("id_carburant", options.carburants, "type", vehicule.id_carburant);
        populateSelect("id_transmission", options.transmissions, "type", vehicule.id_transmission);
        populateSelect("id_places", options.places, "nombre", vehicule.id_places);
        populateSelect("id_couleur", options.couleurs, "nom", vehicule.id_couleur);
        populateSelect("id_categorie", options.categories, "nom", vehicule.id_categorie);

        const photoPreview = modalUpdate.querySelector("#photoPreview");
        const photoLabel = modalUpdate.querySelector("#photoLabel");

        if (vehicule.photo) {
            photoPreview.src = vehicule.photo;
            photoPreview.style.display = "block";
            photoLabel.textContent = "Photo du véhicule";
        } else {
            photoPreview.style.display = "none";
            photoLabel.textContent = "Pas encore de photo";
        }

        const marqueSelect = modalUpdate.querySelector("#id_marque");
        const modeleSelect = modalUpdate.querySelector("#id_modele");
        const nomInput = modalUpdate.querySelector("#nom");

        function updateNomVehicule() {
            const marqueText = marqueSelect.options[marqueSelect.selectedIndex]?.text || '';
            const modeleText = modeleSelect.options[modeleSelect.selectedIndex]?.text || '';

            if (marqueText && modeleText) {
                nomInput.value = marqueText + ' ' + modeleText;
            } else {
                nomInput.value = '';
            }
        }

        marqueSelect.addEventListener('change', updateNomVehicule);
        modeleSelect.addEventListener('change', updateNomVehicule);
        updateNomVehicule();
    }

    closeUpdateBtn.addEventListener("click", () => {
        modalUpdate.style.display = "none";
    });

    document.querySelectorAll(".btn-edit").forEach(button => {
        button.addEventListener("click", () => {
            const vehicule = JSON.parse(button.dataset.vehicule);
            const options = JSON.parse(button.dataset.options);
            openUpdateModal(vehicule, options);
        });
    });
});
