<h1>Réservations</h1>

<?php if ($reservations) : ?>
    <div class="order-admin">
        <table>
            <thead>
                <tr>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Email</th>
                    <th>Ville</th>
                    <th>Numéro de téléphone</th>
                    <th>Véhicule</th>
                    <th>Année du véhicule</th>
                    <th>Description du véhicule</th>
                    <th>Montant</th>
                    <th>Forfait</th>
                    <th>Date</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($reservations as $reservation): ?>
                    <tr>
                        <td><?= htmlspecialchars($reservation->nom) ?></td>
                        <td><?= htmlspecialchars($reservation->prenom) ?></td>
                        <td><?= htmlspecialchars($reservation->email) ?></td>
                        <td><?= htmlspecialchars($reservation->ville) ?></td>
                        <td><?= htmlspecialchars($reservation->numero_telephone) ?></td>
                        <td><?= htmlspecialchars($reservation->vehicule_nom) ?></td>
                        <td><?= htmlspecialchars($reservation->annee) ?></td>
                        <td><?= htmlspecialchars($reservation->description) ?></td>
                        <td><?= htmlspecialchars($reservation->montant) ?> €</td>
                        <td><?= htmlspecialchars($reservation->forfait) ?></td>
                        <td><?= htmlspecialchars($reservation->date_debut) ?> au <?= htmlspecialchars($reservation->date_fin) ?></td>
                        <td>
                            <form method="post" action="index.php?controller=Admin&action=createArchive">
                                <input type="hidden" name="nom" value="<?= htmlspecialchars($reservation->nom) ?>">
                                <input type="hidden" name="prenom" value="<?= htmlspecialchars($reservation->prenom) ?>">
                                <input type="hidden" name="email" value="<?= htmlspecialchars($reservation->email) ?>">
                                <input type="hidden" name="ville" value="<?= htmlspecialchars($reservation->ville) ?>">
                                <input type="hidden" name="numero_telephone" value="<?= htmlspecialchars($reservation->numero_telephone) ?>">
                                <input type="hidden" name="nom_vehicule" value="<?= htmlspecialchars($reservation->vehicule_nom) ?>">
                                <input type="hidden" name="modele" value="<?= htmlspecialchars($reservation->modele_nom) ?>">
                                <input type="hidden" name="marque" value="<?= htmlspecialchars($reservation->marque_nom) ?>">
                                <input type="hidden" name="categorie_vehicule" value="<?= htmlspecialchars($reservation->categorie_nom) ?>">
                                <input type="hidden" name="montant" value="<?= htmlspecialchars($reservation->montant) ?>">
                                <input type="hidden" name="date" value="<?= htmlspecialchars($reservation->date_debut) ?>">
                                <button type="submit">Archiver</button>
                            </form>
                        </td>
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
