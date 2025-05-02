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
                    <button class="btn-edit"
                        data-vehicule='<?= htmlspecialchars(json_encode($vehicule), ENT_QUOTES, 'UTF-8') ?>'
                        data-options='<?= htmlspecialchars(json_encode($options), ENT_QUOTES, 'UTF-8') ?>'>
                        Modifier
                    </button>
                </div>
                <div class="order-admin-one">
                    <a href="index.php?controller=Admin&action=deleteCar&id_vehicule=<?= htmlspecialchars($vehicule->id_vehicule) ?>">Supprimer</a>
                </div>
                <div class="order-admin-one">
                    <a href="index.php?controller=Admin&action=orderCars">Retour</a>
                </div>
            </div>
        <?php endif; ?>
        <!-- MODALE DE MISE À JOUR D'UN VÉHICULE -->
        <div class="modal modalUpdate">
            <div class="modal-update modalUpdate-content">
                <span class="close closeUpdate">&times;</span>
                <h2>Modifier un véhicule</h2>

                <form method="POST" action="index.php?controller=Admin&action=updateCar" enctype="multipart/form-data" class="form-update-admin">
                    <input type="hidden" id="id_vehicule" name="id_vehicule" readonly>

                    <div class="form-group-admin">
                        <label for="nom">Nom du véhicule :</label>
                        <input type="text" id="nom" name="nom" class="form-input-admin" required readonly>
                    </div>

                    <div class="form-group-admin">
                        <label for="prix_km">Prix au km :</label>
                        <input type="number" step="0.01" id="prix_km" name="prix_km" class="form-input-admin" required>
                    </div>

                    <div class="form-group-admin">
                        <label for="prix_jour">Prix par jour :</label>
                        <input type="number" step="0.01" id="prix_jour" name="prix_jour" class="form-input-admin" required>
                    </div>

                    <div class="form-group-admin">
                        <label for="prix_semaine">Prix par semaine :</label>
                        <input type="number" step="0.01" id="prix_semaine" name="prix_semaine" class="form-input-admin">
                    </div>

                    <div class="form-group-admin">
                        <label for="prix_mois">Prix par mois :</label>
                        <input type="number" step="0.01" id="prix_mois" name="prix_mois" class="form-input-admin">
                    </div>

                    <div class="form-group-admin">
                        <label for="annee">Année :</label>
                        <input type="number" id="annee" name="annee" class="form-input-admin" required>
                    </div>

                    <div class="form-group-admin">
                        <label for="description">Description :</label>
                        <textarea id="description" name="description" class="form-input-admin" required></textarea>
                    </div>

                    <div class="form-group-admin">
                        <label for="statut">Statut :</label>
                        <select id="statut" name="statut" class="form-input-admin">
                            <option value="Disponible">Disponible</option>
                            <option value="Réserver">Réserver</option>
                            <option value="Loué">Loué</option>
                            <option value="Maintenance">Maintenance</option>
                        </select>
                    </div>

                    <div class="form-group-admin">
                        <label for="id_modele">Modèle :</label>
                        <select id="id_modele" name="id_modele" class="form-input-admin"></select>
                    </div>

                    <div class="form-group-admin">
                        <label for="id_marque">Marque :</label>
                        <select id="id_marque" name="id_marque" class="form-input-admin"></select>
                    </div>

                    <div class="form-group-admin">
                        <label for="id_carburant">Carburant :</label>
                        <select id="id_carburant" name="id_carburant" class="form-input-admin"></select>
                    </div>

                    <div class="form-group-admin">
                        <label for="id_transmission">Transmission :</label>
                        <select id="id_transmission" name="id_transmission" class="form-input-admin"></select>
                    </div>

                    <div class="form-group-admin">
                        <label for="id_places">Nombre de places :</label>
                        <select id="id_places" name="id_places" class="form-input-admin"></select>
                    </div>

                    <div class="form-group-admin">
                        <label for="id_couleur">Couleur :</label>
                        <select id="id_couleur" name="id_couleur" class="form-input-admin"></select>
                    </div>

                    <div class="form-group-admin">
                        <label for="id_categorie">Catégorie :</label>
                        <select id="id_categorie" name="id_categorie" class="form-input-admin"></select>
                    </div>

                    <div class="form-group-admin">
                        <label for="photo">Photo :</label>
                        <input type="file" id="photo" name="photo" class="form-input-admin">
                        <img id="photoPreview" src="" alt="Photo actuelle" style="max-width: 100px; display: none;">
                        <p id="photoLabel">Pas encore de photo</p>
                    </div>

                    <div class="form-group-admin">
                        <button type="submit">Modifier</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php $scripts = ["admin/nameCar", "admin/updateCar"]; ?>