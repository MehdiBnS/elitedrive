
document.addEventListener('DOMContentLoaded', function () {
    const typeForfait = document.getElementById('forfait');
    const quantite = document.getElementById('quantite_forfait');
    const montant = document.getElementById('montant_affiche');

    const prix = {
        KM: parseFloat(document.getElementById('prix_km').value),
        Jour: parseFloat(document.getElementById('prix_jour').value),
        Semaine: parseFloat(document.getElementById('prix_semaine').value),
        Mois: parseFloat(document.getElementById('prix_mois').value)
    };

    function calculerMontant() {
        const type = typeForfait.value;
        const qte = parseFloat(quantite.value);
        if (!isNaN(qte) && prix[type]) {
            const total = qte * prix[type];
            montant.value = total.toFixed(2);
        } else {
            montant.value = '';
        }
    }

    typeForfait.addEventListener('change', calculerMontant);
    quantite.addEventListener('input', calculerMontant);
});