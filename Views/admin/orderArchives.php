<?php if ($archives): ?>
    <div class="order-admin">
        <h2 style="color: black;">Archives</h2>
        <div class="navbar-admin">
            <div class="order-admin-button">
                <a href="index.php?controller=Admin&action=backOffice">Retour</a>
            </div>
            <form method="post" action="index.php?controller=Admin&action=orderArchives" class="filter-form">
                <input type="text" name="search" placeholder="Rechercher une archive" value="<?= htmlspecialchars($search ?? '') ?>">
                <button type="submit" class="filter-button">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                        <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0" />
                    </svg>
                </button>
                <a href="index.php?controller=Admin&action=orderArchives" style="margin-left: 10px;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-arrow-counterclockwise" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M8 3a5 5 0 1 1-4.546 2.914.5.5 0 0 0-.908-.417A6 6 0 1 0 8 2z" />
                        <path d="M8 4.466V.534a.25.25 0 0 0-.41-.192L5.23 2.308a.25.25 0 0 0 0 .384l2.36 1.966A.25.25 0 0 0 8 4.466" />
                    </svg>
                </a>
            </form>
            <div class="order-admin-button">
                <a href="index.php?controller=Admin&action=orderReservations">Ajouter des archives</a>

            </div>
        </div>
        <table id="archiveTable">
            <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Téléphone</th>
                <th>Ville</th>
                <th>Email</th>
                <th>Véhicule</th>
                <th>Modèle</th>
                <th>Marque</th>
                <th>Catégorie</th>
                <th>Montant (€)</th>
                <th>Date</th>
                <th>Action</th>
            </tr>
            <?php foreach ($archives as $archive): ?>
                <tr>
                    <td><?= htmlspecialchars($archive->id_archive) ?></td>
                    <td><?= htmlspecialchars($archive->nom) ?></td>
                    <td><?= htmlspecialchars($archive->prenom) ?></td>
                    <td><?= htmlspecialchars($archive->numero_telephone) ?></td>
                    <td><?= htmlspecialchars($archive->ville) ?></td>
                    <td><?= htmlspecialchars($archive->email) ?></td>
                    <td><?= htmlspecialchars($archive->nom_vehicule) ?></td>
                    <td><?= htmlspecialchars($archive->modele) ?></td>
                    <td><?= htmlspecialchars($archive->marque) ?></td>
                    <td><?= htmlspecialchars($archive->categorie_vehicule) ?></td>
                    <td><?= htmlspecialchars(number_format($archive->montant, 2)) ?></td>
                    <td><?= htmlspecialchars($archive->date) ?></td>
                    <td>
                        <a href="index.php?controller=Admin&action=orderArchiveOne&id_archive=<?= htmlspecialchars($archive->id_archive) ?>">Afficher</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>
<?php else: ?>
    <div class="order-admin">
        <p>Aucune archive trouvée.</p>
    </div>
<?php endif; ?>

<?php $scripts = ["admin/searchArchive"]; ?>