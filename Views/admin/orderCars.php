<?php if ($vehicules) : ?>
    <div class="order-admin">
        <h1 style="color: black;">Véhicules</h1>
        <div class="navbar-admin">
            <div class="order-admin-button">
                <a href="index.php?controller=Admin&action=backOffice">Retour</a>
            </div>

            <form method="post" action="index.php?controller=Admin&action=orderCars" class="filter-form">
                <input type="text" name="search" placeholder="Rechercher un véhicule" value="<?= htmlspecialchars($search ?? '') ?>">
                <button type="submit" class="filter-button">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                        <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0" />
                    </svg>
                </button>
                <a href="index.php?controller=Admin&action=orderCars" style="margin-left: 10px;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-arrow-counterclockwise" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M8 3a5 5 0 1 1-4.546 2.914.5.5 0 0 0-.908-.417A6 6 0 1 0 8 2z" />
                        <path d="M8 4.466V.534a.25.25 0 0 0-.41-.192L5.23 2.308a.25.25 0 0 0 0 .384l2.36 1.966A.25.25 0 0 0 8 4.466" />
                    </svg>
                </a>
            </form>

            <button class="openModalBtn">Ajouter un véhicule</button>
            <!-- Modale -->
            <div class="modal modalsAdmin">
                <div class="modal-content" style="width: 100%; max-width: 900px;">

                    <span class="close">&times;</span>
                    <h2>Créer un véhicule</h2>
                    <form id="createCarForm" method="POST" action="index.php?controller=Admin&action=createCar" enctype="multipart/form-data" class="form-cars-create" style="display: flex; flex-direction: row; justify-content:center; align-items: center; justify-content: space-between;">
                        <div style="display: flex; flex-direction: column; gap: 10px;width:100%">
                            <label for="nom">Nom du véhicule :</label>
                            <input type="text" id="nom" name="nom" required readonly>

                            <label for="prix_km">Prix au km :</label>
                            <input type="number" step="0.01" id="prix_km" name="prix_km" required>

                            <label for="prix_jour">Prix par jour :</label>
                            <input type="number" step="0.01" id="prix_jour" name="prix_jour" required>

                            <label for="prix_semaine">Prix par semaine :</label>
                            <input type="number" step="0.01" id="prix_semaine" name="prix_semaine">

                            <label for="prix_mois">Prix par mois :</label>
                            <input type="number" step="0.01" id="prix_mois" name="prix_mois">

                            <label for="annee">Année :</label>
                            <input type="number" id="annee" name="annee" required>

                            <label for="description">Description :</label>
                            <textarea id="description" name="description" required></textarea>

                            <label for="statut">Statut :</label>
                            <select id="statut" name="statut">
                                <option value="Disponible">Disponible</option>
                                <option value="Réserver">Réserver</option>
                                <option value="Loué">Loué</option>
                                <option value="Maintenance">Maintenance</option>
                            </select>
                        </div>
                        <div>
                            <div style="display: flex; flex-direction: column; gap: 10px;">
                                <label for="id_categorie">Catégorie :</label>
                                <select id="id_categorie" name="id_categorie" required>
                                    <option value="">Choisir une catégorie</option>
                                    <?php foreach ($options['categories'] as $categorie): ?>
                                        <option value="<?= $categorie['id_categorie']; ?>"><?= htmlspecialchars($categorie['nom']); ?></option>
                                    <?php endforeach; ?>
                                </select>

                                <label for="id_modele">Modèle :</label>
                                <select id="id_modele" name="id_modele" required>
                                    <option value="">Choisir un modèle</option>
                                    <?php foreach ($options['modeles'] as $modele): ?>
                                        <option value="<?= $modele['id_modele']; ?>"><?= htmlspecialchars($modele['nom']); ?></option>
                                    <?php endforeach; ?>
                                </select>

                                <label for="id_marque">Marque :</label>
                                <select id="id_marque" name="id_marque" required>
                                    <option value="">Choisir une marque</option>
                                    <?php foreach ($options['marques'] as $marque): ?>
                                        <option value="<?= $marque['id_marque']; ?>"><?= htmlspecialchars($marque['nom']); ?></option>
                                    <?php endforeach; ?>
                                </select>

                                <label for="id_carburant">Carburant :</label>
                                <select id="id_carburant" name="id_carburant">
                                    <option value="">Choisir un carburant</option>
                                    <?php foreach ($options['carburants'] as $carburant): ?>
                                        <option value="<?= $carburant['id_carburant']; ?>"><?= htmlspecialchars($carburant['type']); ?></option>
                                    <?php endforeach; ?>
                                </select>

                                <label for="id_transmission">Transmission :</label>
                                <select id="id_transmission" name="id_transmission">
                                    <option value="">Choisir une transmission</option>
                                    <?php foreach ($options['transmissions'] as $transmission): ?>
                                        <option value="<?= $transmission['id_transmission']; ?>"><?= htmlspecialchars($transmission['type']); ?></option>
                                    <?php endforeach; ?>
                                </select>

                                <label for="id_places">Nombre de places :</label>
                                <select id="id_places" name="id_places">
                                    <option value="">Choisir le nombre de places</option>
                                    <?php foreach ($options['places'] as $place): ?>
                                        <option value="<?= $place['id_places']; ?>"><?= htmlspecialchars($place['nombre']); ?></option>
                                    <?php endforeach; ?>
                                </select>

                                <label for="id_couleur">Couleur :</label>
                                <select id="id_couleur" name="id_couleur">
                                    <option value="">Choisir une couleur</option>
                                    <?php foreach ($options['couleurs'] as $couleur): ?>
                                        <option value="<?= $couleur['id_couleur']; ?>"><?= htmlspecialchars($couleur['nom']); ?></option>
                                    <?php endforeach; ?>
                                </select>

                                <label for="photo">Photo :</label>
                                <input type="file" id="photo" name="photo" accept="image/*">

                                <button type="submit">Créer</button>
                                <p id="statusMessage" style="text-align: center; color: darkgoldenrod"></p>

                            </div>


                        </div>
                    </form>
                </div>
            </div>
        </div>

        <table id="vehiculesTable">

            <thead>
                <tr>
                    <th>Nom</th>
                    <th>Prix par km</th>
                    <th>Prix par jour</th>
                    <th>Prix par semaine</th>
                    <th>Prix par mois</th>
                    <th>Année</th>
                    <th>Description</th>
                    <th>Statut</th>
                    <th>Date de création</th>
                    <th>Photo</th>
                    <th>Supprimer</th>
                    <th>Modifier</th>
                    <th>Afficher</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($vehicules as $v) : ?>
                    <tr>
                        <td><?= htmlspecialchars($v->nom) ?></td>
                        <td><?= htmlspecialchars($v->prix_km) ?> €</td>
                        <td><?= htmlspecialchars($v->prix_jour) ?> €</td>
                        <td><?= htmlspecialchars($v->prix_semaine) ?> €</td>
                        <td><?= htmlspecialchars($v->prix_mois) ?> €</td>
                        <td><?= htmlspecialchars($v->annee) ?></td>
                        <td><?= htmlspecialchars($v->description) ?></td>
                        <td><?= htmlspecialchars($v->statut) ?></td>
                        <td><?= htmlspecialchars($v->date_creation) ?></td>
                        <td>
                            <?php if ($v->photo) : ?>
                                <img src="<?= htmlspecialchars($v->photo) ?>" alt="Photo de <?= htmlspecialchars($v->nom) ?>" width="100">
                            <?php else : ?>
                                Pas de photo
                            <?php endif; ?>
                        </td>
                        <td><a href="index.php?controller=Admin&action=deleteCar&id_vehicule=<?= htmlspecialchars($v->id_vehicule) ?>">Supprimer</a></td>
                        <td><button class="btn-edit"
                                data-vehicule='<?= htmlspecialchars(json_encode($v), ENT_QUOTES, 'UTF-8') ?>'
                                data-options='<?= htmlspecialchars(json_encode($options), ENT_QUOTES, 'UTF-8') ?>'>
                                Modifier
                            </button>
                        </td>
                        <td><a href="index.php?controller=Admin&action=orderCarOne&id_vehicule=<?= htmlspecialchars($v->id_vehicule) ?>">Afficher</a></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
<?php else : ?>
    <div class="order-admin">
        Aucun véhicule trouvé.
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


<?php $scripts = ["admin/searchCar", "admin/addCar", "modals", "admin/nameCar", "admin/updateCar"]; ?>