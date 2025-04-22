<h1>Avis</h1>

<?php if ($avis): ?>
    <div class="order-admin">
        <table>
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

<div class="order-admin">
    <a href="index.php?controller=Admin&action=backOffice">Retour</a>
</div>