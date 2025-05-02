document.addEventListener('DOMContentLoaded', function () {
    const searchInput = document.querySelector('.filter-form input[name="search"]');
    const table = document.getElementById('vehiculesTable');  // Référence au tableau actuel

    searchInput.addEventListener('input', function () {
        const query = this.value.trim();

        fetch('index.php?controller=Admin&action=orderCars', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            body: 'search=' + encodeURIComponent(query)
        })
            .then(response => response.text())
            .then(html => {
                console.log(html);  // Affiche la réponse complète du serveur

                const tempDiv = document.createElement('div');
                tempDiv.innerHTML = html;

                const newTableBody = tempDiv.querySelector('#vehiculesTable tbody');
                if (newTableBody) {
                    table.querySelector('tbody').innerHTML = newTableBody.innerHTML; // Remplace seulement le <tbody>
                } else {
                    console.error('Tableau non trouvé dans la réponse');
                }
            })
            .catch(error => console.error('Erreur AJAX:', error));
    });
});
