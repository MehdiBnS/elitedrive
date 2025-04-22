<h1>Véhicules</h1>

<?php if ($vehicules) : ?>
    <div class="order-admin">
        <table>
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
                        <td><a href="index.php?controller=Admin&action=updateCarForm&id_vehicule=<?= htmlspecialchars($v->id_vehicule) ?>">Modifier</a></td>
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
<div class="order-admin">
<button class="openModalBtn">Ajouter un véhicule</button>
<!-- Modale -->
<div class="modal modalsAdmin">
    <div class="modal-content" style="width: 100%; max-width: 900px;">

        <span class="close">&times;</span>
        <h2>Créer un véhicule</h2>
        <form method="POST" action="index.php?controller=Admin&action=createCar" enctype="multipart/form-data" class="form-cars-create" style="display: flex; flex-direction: row; justify-content:center; align-items: center; justify-content: space-between;">
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
                </div>


            </div>
    </div>
</div>
</div>



<div class="order-admin">
    <a href="index.php?controller=Admin&action=backOffice">Retour</a>
</div>
