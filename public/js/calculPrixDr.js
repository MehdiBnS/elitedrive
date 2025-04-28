document.addEventListener('DOMContentLoaded', function () {
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

    function verifierDates() {
        if (dateDebut.value && dateFin.value && dateDebut.value > dateFin.value) {
            dateFin.setCustomValidity("La date de fin doit être postérieure ou égale à la date de début.");
        } else {
            dateFin.setCustomValidity("");
        }
    }

    function verifierQuantite() {
        if (quantite.value < 0) {
            quantite.setCustomValidity("La quantité ne peut pas être négative.");
        } else {
            quantite.setCustomValidity("");
        }
    }

    typeForfait.addEventListener('change', calculerMontant);
    quantite.addEventListener('input', function () {
        verifierQuantite();
        calculerMontant();
    });
    dateDebut.addEventListener('change', verifierDates);
    dateFin.addEventListener('change', verifierDates);
});
