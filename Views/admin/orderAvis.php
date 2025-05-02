<?php if ($avis): ?>
    <div class="order-admin">
        <h1 style="color: black;">Avis</h1>
        <div class="navbar-admin">
            <div class="order-admin-button">
                <a href="index.php?controller=Admin&action=backOffice">Retour</a>
            </div>
            <form method="post" action="index.php?controller=Admin&action=orderAvis" class="filter-form">
                <input type="text" name="search" placeholder="Rechercher un avis" value="<?= htmlspecialchars($search ?? '') ?>">
                <button type="submit" class="filter-button">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                        <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0" />
                    </svg>
                </button>
                <a href="index.php?controller=Admin&action=orderAvis" style="margin-left: 10px;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-arrow-counterclockwise" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M8 3a5 5 0 1 1-4.546 2.914.5.5 0 0 0-.908-.417A6 6 0 1 0 8 2z" />
                        <path d="M8 4.466V.534a.25.25 0 0 0-.41-.192L5.23 2.308a.25.25 0 0 0 0 .384l2.36 1.966A.25.25 0 0 0 8 4.466" />
                    </svg>
                </a>
            </form>
        </div>
        <table id="avisTable">
            <tr>
                <th>ID</th>
                <th>Utilisateur</th>
                <th>Véhicule</th>
                <th>Note</th>
                <th>Commentaire</th>
                <th>Date</th>
                <th>Supprimer</th>
                <th>Afficher</th>
            </tr>
            <?php foreach ($avis as $a): ?>
                <tr>
                    <td><?= htmlspecialchars($a->id_avis) ?></td>
                    <td><?= htmlspecialchars($a->nom) . ' ' . htmlspecialchars($a->prenom) ?></td>
                    <td><?= htmlspecialchars($a->nom_vehicule) ?></td>
                    <td><?= htmlspecialchars($a->note) ?> / 5</td>
                    <td><?= empty($a->commentaire) ? 'Aucun commentaire' : htmlspecialchars($a->commentaire) ?></td>
                    <td><?= htmlspecialchars($a->date_creation) ?></td>
                    <td>
                        <a href="index.php?controller=Admin&action=deleteAvis&id_avis=<?= htmlspecialchars($a->id_avis) ?>">Supprimer</a>
                    </td>
                    <td>
                        <a href="index.php?controller=Admin&action=orderAvisOne&id_avis=<?= htmlspecialchars($a->id_avis) ?>">Afficher</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>
<?php else: ?>
    <div class="order-admin">
        Aucun avis trouvé.
    </div>
<?php endif; ?>
<?php $scripts = ["admin/searchAvis"]; ?>