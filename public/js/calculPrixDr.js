document.addEventListener('DOMContentLoaded', function () {

    flatpickr("#date_debut", {
        dateFormat: "Y-m-d",
        minDate: "today",
        locale: "fr",
        allowInput: true,
        monthSelectorType: 'dropdown', 
        yearSelectorType: 'dropdown',
    });
    flatpickr("#date_fin", {
        dateFormat: "Y-m-d",
        minDate: "today",
        locale: "fr",
        allowInput: true,
        monthSelectorType: 'dropdown', 
        yearSelectorType: 'dropdown',
    });

    const typeForfait = document.getElementById('forfait');
    const quantite = document.getElementById('quantite_forfait');
    const montant = document.getElementById('montant_affiche');
    const dateDebut = document.getElementById('date_debut');
    const dateFin = document.getElementById('date_fin');



    const prix = {
        KM: parseFloat(document.getElementById('prix_km').value),
        Jour: parseFloat(document.getElementById('prix_jour').value),
        Semaine: parseFloat(document.getElementById('prix_semaine').value),
        Mois: parseFloat(document.getElementById('prix_mois').value)
    };

    function calculerQuantite() {
        const type = typeForfait.value;
        const d1 = new Date(dateDebut.value);
        const d2 = new Date(dateFin.value);



        if (!dateDebut.value || !dateFin.value || d1 > d2) {
            quantite.value = '';
            return;
        }

        const diffTime = d2 - d1;
        const diffDays = Math.floor(diffTime / (1000 * 60 * 60 * 24)) + 1;

        console.log("Date Début (format brut):", dateDebut.value); // Affiche la valeur brute du champ dateDebut
        console.log("Date Fin (format brut):", dateFin.value); // Affiche la valeur brute du champ dateFin

        // Afficher les dates en format lisible
        console.log("Date Début (format lisible):", d1.toString());
        console.log("Date Fin (format lisible):", d2.toString());
        let qte = 0;
        if (type === 'Jour') {
            qte = diffDays;
        } else if (type === 'Semaine') {
            qte = Math.floor(diffDays / 7);
            qte = qte === 0 ? 1 : qte;
        } else if (type === 'Mois') {
            qte = (d2.getFullYear() - d1.getFullYear()) * 12 + (d2.getMonth() - d1.getMonth());

            if (d2.getDate() < d1.getDate()) {
                qte -= 1;
            }
            
            if (qte < 1) {
                qte = 1;
            }
        }

        quantite.value = qte;
    }

    function updateChampQuantite() {
        const type = typeForfait.value;
        const isKM = type === 'KM';
        quantite.readOnly = !isKM;

        if (!isKM) {
            calculerQuantite();
        }
        calculerMontant();
    }

    function calculerMontant() {
        const type = typeForfait.value;
        const qte = parseFloat(quantite.value);
        if (!isNaN(qte) && qte >= 0 && prix[type]) {
            const total = qte * prix[type];
            montant.value = total.toFixed(2);
        } else {
            montant.value = '';
        }
    }


    typeForfait.addEventListener('change', updateChampQuantite);
    dateDebut.addEventListener('change', function () {
        updateChampQuantite();
    });
    dateFin.addEventListener('change', function () {
        updateChampQuantite();
    });
    quantite.addEventListener('input', function () {
        if (typeForfait.value === 'KM') {
            if (quantite.value < 0 || quantite.value > 10000) {
                quantite.setCustomValidity("Quantité de KM invalide (0 à 10000).");
            } else {
                quantite.setCustomValidity("");
            }
            calculerMontant();
        }
    });

    updateChampQuantite();
});

const form = document.querySelector('#form-demande-reservation');

form.addEventListener('submit', function (e) {
    e.preventDefault();

    const formData = new FormData(form);

    fetch(form.action, {
        method: 'POST',
        body: formData
    })
        .then(response => {
            if (!response.ok) throw new Error('Erreur réseau');
            return response.json();
        })
        .then(data => {
            if (data.success) {
                window.location.href = 'index.php?controller=Utilisateur&action=showProfile';
            } else if (data.error) {
                alert(data.error);
            }
        })
        .catch(error => {
            alert('Une erreur est survenue. Veuillez réessayer.');
            console.error(error, d1.value, d2.value);
        });
});
