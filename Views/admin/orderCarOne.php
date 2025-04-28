<div class="background-wrapper">
    <div class="background-image" style="background-image: url('<?= $vehicule->photo ?? '' ?>');"></div>
    <div class="container-admin-one">
        <h1>
            <?php if ($vehicule): ?>
                <?= htmlspecialchars($vehicule->marque ?? 'Marque inconnue') ?>
                <?= htmlspecialchars($vehicule->modele ?? 'Modèle inconnu') ?>
            <?php else: ?>
                Aucun véhicule trouvé
            <?php endif; ?>
        </h1>

        <?php if ($vehicule): ?>

            <!-- Description -->
            <div class="order-admin-one">
                <h2>Description</h2>
                <p><?= !empty($vehicule->description) ? nl2br(htmlspecialchars($vehicule->description)) : 'Aucune description' ?></p>
            </div>

            <!-- Tableau des prix -->
            <div class="order-admin-one">
                <h2>Tarifs</h2>
                <table>
                    <tr>
                        <td><strong>Prix au km :</strong></td>
                        <td><?= $vehicule->prix_km !== null ? htmlspecialchars($vehicule->prix_km) . ' €' : 'Non renseigné' ?></td>
                    </tr>
                    <tr>
                        <td><strong>Prix par jour :</strong></td>
                        <td><?= $vehicule->prix_jour !== null ? htmlspecialchars($vehicule->prix_jour) . ' €' : 'Non renseigné' ?></td>
                    </tr>
                    <tr>
                        <td><strong>Prix par semaine :</strong></td>
                        <td><?= $vehicule->prix_semaine !== null ? htmlspecialchars($vehicule->prix_semaine) . ' €' : 'Non renseigné' ?></td>
                    </tr>
                    <tr>
                        <td><strong>Prix par mois :</strong></td>
                        <td><?= $vehicule->prix_mois !== null ? htmlspecialchars($vehicule->prix_mois) . ' €' : 'Non renseigné' ?></td>
                    </tr>
                </table>
            </div>

            <!-- Tableau des caractéristiques -->
            <div class="order-admin-one">
                <h2>Caractéristiques</h2>
                <table>
                    <tr>
                        <td><strong>Année :</strong></td>
                        <td><?= $vehicule->annee ?? 'Non renseignée' ?></td>
                    </tr>
                    <tr>
                        <td><strong>Statut :</strong></td>
                        <td><?= $vehicule->statut ?? 'Non défini' ?></td>
                    </tr>
                    <tr>
                        <td><strong>Carburant :</strong></td>
                        <td><?= $vehicule->carburant ?? 'Non précisé' ?></td>
                    </tr>
                    <tr>
                        <td><strong>Transmission :</strong></td>
                        <td><?= $vehicule->transmission ?? 'Non précisée' ?></td>
                    </tr>
                    <tr>
                        <td><strong>Nombre de places :</strong></td>
                        <td><?= $vehicule->places !== null ? htmlspecialchars($vehicule->places) : 'Non défini' ?></td>
                    </tr>
                    <tr>
                        <td><strong>Couleur :</strong></td>
                        <td><?= $vehicule->couleur ?? 'Non précisée' ?></td>
                    </tr>
                    <tr>
                        <td><strong>Catégorie :</strong></td>
                        <td><?= $vehicule->categorie ?? 'Non précisée' ?></td>
                    </tr>
                    <tr>
                        <td><strong>Date de création :</strong></td>
                        <td><?= $vehicule->date_creation ?? 'Non disponible' ?></td>
                    </tr>
                </table>
            </div>

            <!-- Boutons d'action -->
            <div class="order-admin-one-button">
                <div class="order-admin-one">
                    <a href="index.php?controller=Admin&action=updateCarForm&id_vehicule=<?= htmlspecialchars($vehicule->id_vehicule) ?>">Modifier</a>
                </div>
                <div class="order-admin-one">
                    <a href="index.php?controller=Admin&action=deleteCar&id_vehicule=<?= htmlspecialchars($vehicule->id_vehicule) ?>">Supprimer</a>
                </div>
                <div class="order-admin-one">
                    <a href="index.php?controller=Admin&action=orderCars">Retour</a>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>