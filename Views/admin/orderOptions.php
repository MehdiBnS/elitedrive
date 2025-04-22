<h1>Options du Véhicule</h1>

<div class="accordion-wrapper-admin">

    <!-- COLONNE DE GAUCHE : HEADERS -->
    <div class="accordion-headers-admin">
        <button class="accordion-header-admin">Catégories</button>
        <button class="accordion-header-admin">Modèles</button>
        <button class="accordion-header-admin">Marques</button>
        <button class="accordion-header-admin">Carburants</button>
        <button class="accordion-header-admin">Transmissions</button>
        <button class="accordion-header-admin">Nombre de places</button>
        <button class="accordion-header-admin">Couleurs</button>
        <a href="index.php?controller=Admin&action=backOffice" class="accordion-header-admin">Retour</a>
    </div>

    <!-- COLONNE DE DROITE : CONTENUS -->
    <div class="accordion-contents-admin">
        <!-- CATEGORIES -->
        <div class="accordion-content-admin">
            <button class="openModalBtn">Ajouter une Catégorie</button>
            <!-- Modal -->
            <div class="modal modalsAdmin">
                <div class="modal-content">
                    <span class="close">&times;</span>
                    <h2>Ajouter une Catégorie</h2>
                    <form method="POST" action="index.php?controller=Admin&action=createCategory" enctype="multipart/form-data" class="form-cars-create">
                        <label for="nom">Nom de la catégorie :</label>
                        <input type="text" id="nom" name="nom" required>
                        <label for="description">Description :</label>
                        <textarea name="description" id="description"></textarea>
                        <label for="photo">Photo :</label>
                        <input type="file" name="photo" id="photo">
                        <button type="submit">Créer</button>
                    </form>
                </div>
            </div>
            <ul>
                <?php foreach ($options['categories'] as $categorie): ?>
                    <li>
                        <?= htmlspecialchars($categorie['nom']) ?>
                        <?php if ($categorie['photo']): ?>
                            <img src="<?= htmlspecialchars($categorie['photo']) ?>" alt="Image de la catégorie">
                        <?php else: ?>
                            <p>Aucune image disponible</p>
                        <?php endif; ?>
                        <p><?= htmlspecialchars($categorie['description']) ?></p>
                        <a href="index.php?controller=Admin&action=updateCategoryForm&id_categorie=<?= $categorie['id_categorie'] ?>">Modifier</a>
                        <a href="index.php?controller=Admin&action=deleteCategory&id_categorie=<?= $categorie['id_categorie'] ?>">Supprimer</a>
                    </li>
                <?php endforeach; ?>
            </ul>

        </div>

        <!-- MODELES -->
        <div class="accordion-content-admin">
            <button class="openModalBtn">Ajouter un Modèle</button>
            <div class="modal modalsAdmin">
                <div class="modal-content">
                    <span class="close">&times;</span>
                    <h2>Ajouter un Modèle</h2>
                    <form method="POST" action="index.php?controller=Admin&action=createModele" class="form-cars-create">
                        <label for="nom">Nom du modèle :</label>
                        <input type="text" id="nom" name="nom" required>
                        <button type="submit">Créer</button>
                    </form>
                </div>
            </div>
            <ul>
                <?php foreach ($options['modeles'] as $modele): ?>
                    <li>
                        <?= htmlspecialchars($modele['nom']) ?>
                        <a href="index.php?controller=Admin&action=updateModeleForm&id_modele=<?= $modele['id_modele'] ?>">Modifier</a>
                        <a href="index.php?controller=Admin&action=deleteModele&id_modele=<?= $modele['id_modele'] ?>">Supprimer</a>
                    </li>
                <?php endforeach; ?>
            </ul>

        </div>

        <!-- MARQUES -->
        <div class="accordion-content-admin">
            <button class="openModalBtn">Ajouter une Marque</button>
            <div class="modal modalsAdmin">
                <div class="modal-content">
                    <span class="close">&times;</span>
                    <h2>Ajouter une Marque</h2>
                    <form method="POST" action="index.php?controller=Admin&action=createMarque" class="form-cars-create">
                        <label for="marque_nom">Nom de la marque :</label>
                        <input type="text" id="marque_nom" name="nom" required>
                        <button type="submit">Créer</button>
                    </form>
                </div>
            </div>
            <ul>
                <?php foreach ($options['marques'] as $marque): ?>
                    <li>
                        <?= htmlspecialchars($marque['nom']) ?>
                        <a href="index.php?controller=Admin&action=updateMarqueForm&id_marque=<?= $marque['id_marque'] ?>">Modifier</a>
                        <a href="index.php?controller=Admin&action=deleteMarque&id_marque=<?= $marque['id_marque'] ?>">Supprimer</a>
                    </li>
                <?php endforeach; ?>
            </ul>

        </div>

        <!-- CARBURANTS -->
        <div class="accordion-content-admin">
            <button class="openModalBtn">Ajouter un Carburant</button>
            <div class="modal modalsAdmin">
                <div class="modal-content">
                    <span class="close">&times;</span>
                    <h2>Ajouter un Carburant</h2>
                    <form method="POST" action="index.php?controller=Admin&action=createCarburant" class="form-cars-create">
                        <label for="carburant_nom">Type de carburant :</label>
                        <input type="text" id="carburant_nom" name="type" required>
                        <button type="submit">Créer</button>
                    </form>
                </div>
            </div>
            <ul>
                <?php foreach ($options['carburants'] as $carburant): ?>
                    <li>
                        <?= htmlspecialchars($carburant['type']) ?>
                        <a href="index.php?controller=Admin&action=updateCarburantForm&id_carburant=<?= $carburant['id_carburant'] ?>">Modifier</a>
                        <a href="index.php?controller=Admin&action=deleteCarburant&id_carburant=<?= $carburant['id_carburant'] ?>">Supprimer</a>
                    </li>
                <?php endforeach; ?>
            </ul>


        </div>

        <!-- TRANSMISSIONS -->
        <div class="accordion-content-admin">
            <button class="openModalBtn">Ajouter une Transmission</button>
            <div class="modal modalsAdmin">
                <div class="modal-content">
                    <span class="close">&times;</span>
                    <h2>Ajouter une Transmission</h2>
                    <form method="POST" action="index.php?controller=Admin&action=createTransmission" class="form-cars-create">
                        <label for="transmission_nom">Type de transmission :</label>
                        <input type="text" id="transmission_nom" name="type" required>
                        <button type="submit">Créer</button>
                    </form>
                </div>
            </div>
            <ul>
                <?php foreach ($options['transmissions'] as $transmission): ?>
                    <li>
                        <?= htmlspecialchars($transmission['type']) ?>
                        <a href="index.php?controller=Admin&action=updateTransmissionForm&id_transmission=<?= $transmission['id_transmission'] ?>">Modifier</a>
                        <a href="index.php?controller=Admin&action=deleteTransmission&id_transmission=<?= $transmission['id_transmission'] ?>">Supprimer</a>
                    </li>
                <?php endforeach; ?>
            </ul>

        </div>

        <!-- PLACES -->
        <div class="accordion-content-admin">
            <button class="openModalBtn">Ajouter un Nombre de places</button>
            <div class="modal modalsAdmin">
                <div class="modal-content">
                    <span class="close">&times;</span>
                    <h2>Ajouter un Nombre de places</h2>
                    <form method="POST" action="index.php?controller=Admin&action=createPlaces" class="form-cars-create">
                        <label for="places_nombre">Nombre de places :</label>
                        <input type="number" id="places_nombre" name="nombre" required>
                        <button type="submit">Créer</button>
                    </form>
                </div>
            </div>
            <ul>
                <?php foreach ($options['places'] as $place): ?>
                    <li>
                        <?= htmlspecialchars($place['nombre']) ?>
                        <a href="index.php?controller=Admin&action=updatePlacesForm&id_places=<?= $place['id_places'] ?>">Modifier</a>
                        <a href="index.php?controller=Admin&action=deletePlaces&id_places=<?= $place['id_places'] ?>">Supprimer</a>
                    </li>
                <?php endforeach; ?>
            </ul>

        </div>

        <!-- COULEURS -->
        <div class="accordion-content-admin">
            <button class="openModalBtn">Ajouter une Couleur</button>
            <div class="modal modalsAdmin">
                <div class="modal-content">
                    <span class="close">&times;</span>
                    <h2>Ajouter une Couleur</h2>
                    <form method="POST" action="index.php?controller=Admin&action=createCouleur" class="form-cars-create">
                        <label for="couleur_nom">Nom de la couleur :</label>
                        <input type="text" id="couleur_nom" name="nom" required>
                        <button type="submit">Créer</button>
                    </form>
                </div>
            </div>
            <ul>
                <?php foreach ($options['couleurs'] as $couleur): ?>
                    <li>
                        <?= htmlspecialchars($couleur['nom']) ?>
                        <a href="index.php?controller=Admin&action=updateCouleurForm&id_couleur=<?= $couleur['id_couleur'] ?>">Modifier</a>
                        <a href="index.php?controller=Admin&action=deleteCouleur&id_couleur=<?= $couleur['id_couleur'] ?>">Supprimer</a>
                    </li>
                <?php endforeach; ?>
            </ul>

        </div>

    </div>
</div>