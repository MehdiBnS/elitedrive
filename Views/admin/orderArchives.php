<h1>Archives</h1>

<?php if ($archives): ?>
    <div class="order-admin">
        <table>
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

<div class="order-admin">
    <a href="index.php?controller=Admin&action=orderReservations">Ajouter des archives</a>
    
</div>
<div class="order-admin">
<a href="index.php?controller=Admin&action=backOffice">Retour</a>
</div>