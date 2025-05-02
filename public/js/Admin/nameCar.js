
    document.addEventListener('DOMContentLoaded', function () {
        const nomInput = document.getElementById('nom');
        const marqueSelect = document.getElementById('id_marque');
        const modeleSelect = document.getElementById('id_modele');

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
    });

