document.addEventListener("DOMContentLoaded", function () {
    const modalsUpdate = {
        couleur: document.getElementById("modalUpdateCouleur"),
        modele: document.getElementById("modalUpdateModele"),
        marque: document.getElementById("modalUpdateMarque"),
        carburant: document.getElementById("modalUpdateCarburant"),
        transmission: document.getElementById("modalUpdateTransmission"),
        places: document.getElementById("modalUpdatePlaces"),
        categorie: document.getElementById("modalUpdateCategorie")
    };

    const closeButtonsUpdate = {
        couleur: document.querySelector(".closeUpdateCouleur"),
        modele: document.querySelector(".closeUpdateModele"),
        marque: document.querySelector(".closeUpdateMarque"),
        carburant: document.querySelector(".closeUpdateCarburant"),
        transmission: document.querySelector(".closeUpdateTransmission"),
        places: document.querySelector(".closeUpdatePlaces"),
        categorie: document.querySelector(".closeUpdateCategorie")
    };

    const openModalUpdate = (type, data) => {
        const modal = modalsUpdate[type];

        if (modal) {
            if (type === 'couleur') {
                document.getElementById("edit_id_couleur").value = data.id;
                document.getElementById("edit_nom_couleur").value = data.nom;
            } else if (type === 'modele') {
                document.getElementById("edit_id_modele").value = data.id;
                document.getElementById("edit_nom_modele").value = data.nom;
            } else if (type === 'marque') {
                document.getElementById("edit_id_marque").value = data.id;
                document.getElementById("edit_nom_marque").value = data.nom;
            } else if (type === 'carburant') {
                document.getElementById("edit_id_carburant").value = data.id;
                document.getElementById("edit_type_carburant").value = data.carburant;
            } else if (type === 'transmission') {
                document.getElementById("edit_id_transmission").value = data.id;
                document.getElementById("edit_type_transmission").value = data.transmission;
            } else if (type === 'places') {
                document.getElementById("edit_id_places").value = data.id;
                document.getElementById("edit_nombre_places").value = data.nombre;
            } else if (type === 'categorie') {
                document.getElementById("edit_id_categorie").value = data.id;
                document.getElementById("edit_nom_categorie").value = data.nom;
                document.getElementById("edit_description_categorie").value = data.description;
            }
            modal.style.display = "block";
        }
    };

    const editButtons = document.querySelectorAll(".btn-edit");
    editButtons.forEach(button => {
        button.addEventListener("click", function () {
            const type = this.getAttribute("data-type");
            const data = {
                id: this.getAttribute("data-id"),
                nom: this.getAttribute("data-nom") || "",
                description: this.getAttribute("data-description") || "",
                nombre: this.getAttribute("data-nombre") || "",
                type: this.getAttribute("data-type") || "",
                carburant: this.getAttribute("data-carburant") || "",
                transmission: this.getAttribute("data-transmission") || ""
            };
            openModalUpdate(type, data);
        });
    });

    for (const type in modalsUpdate) {
        closeButtonsUpdate[type]?.addEventListener("click", function () {
            modalsUpdate[type].style.display = "none";
        });
    }

    window.addEventListener("click", function (event) {
        for (const type in modalsUpdate) {
            if (event.target === modalsUpdate[type]) {
                modalsUpdate[type].style.display = "none";
            }
        }
    });

    const modalButtons = document.querySelectorAll(".openModalBtn");
    modalButtons.forEach(button => {
        button.addEventListener("click", function () {
            const modal = this.closest(".accordion-content-admin").querySelector(".modal");
            modal.style.display = "block";
        });
    });

    const closeButtons = document.querySelectorAll(".close");
    closeButtons.forEach(button => {
        button.addEventListener("click", function () {
            this.closest(".modal").style.display = "none";
        });
    });

    const forms = {
        category: document.getElementById('formCategory'),
        modele: document.getElementById('formModele'),
        marque: document.getElementById('formMarque'),
        carburant: document.getElementById('formCarburant'),
        transmission: document.getElementById('formTransmission'),
        places: document.getElementById('formPlaces'),
        couleur: document.getElementById('formCouleur')
    };

    for (const formKey in forms) {
        const form = forms[formKey];
        if (form) {
            form.addEventListener("submit", function (event) {
                event.preventDefault();
            });
        }
    }
});
