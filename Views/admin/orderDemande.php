<h1>Demande de réservations</h1>

<?php if ($demandes) : ?>
    <div class="order-admin">
        <table>
            <thead>
                <tr>
                    <th>Véhicule</th>
                    <th>Montant</th>
                    <th>Forfait</th>
                    <th>Date</th>
                    <th>Statut</th>
                    <th>Date de création</th>
                    <th>Afficher</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($demandes as $demande): ?>
                    <tr>
                        <td><?= htmlspecialchars($demande->nom) ?></td>
                        <td><?= htmlspecialchars($demande->montant) ?> €</td>
                        <td><?= htmlspecialchars($demande->forfait) ?></td>
                        <td><?= htmlspecialchars($demande->date_debut) ?> au <?= htmlspecialchars($demande->date_fin) ?></td>
                        <td><?= htmlspecialchars($demande->statut) ?></td>
                        <td><?= htmlspecialchars($demande->date_creation) ?></td>
                        <td><a href="index.php?controller=Admin&action=orderDemandeOne&id_demande=<?= htmlspecialchars($demande->id_demande_reservation) ?>">Afficher</a></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
<?php else: ?>
    <div class="order-admin">
        Aucune réservation trouvée.
    </div>
<?php endif; ?>

<div class="order-admin">
    <a href="index.php?controller=Admin&action=backOffice">Retour</a>
</div>
