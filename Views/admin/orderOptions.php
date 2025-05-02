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
            <p id="statusMessageCategory" style="text-align: center; color: darkgoldenrod"></p>
            <button class="openModalBtn">Ajouter une Catégorie</button>

            <!-- Modal CREATE -->
            <div class="modal modalsAdmin">
                <div class="modal-content">
                    <span class="close">&times;</span>
                    <h2>Ajouter une Catégorie</h2>
                    <form method="POST" action="index.php?controller=Admin&action=createCategory" enctype="multipart/form-data" class="form-cars-create" id="formCategory">
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

            <!-- Modal UPDATE -->
            <div class="modal modalUpdate" id="modalUpdateCategorie">
                <div class="modal-content">
                    <span class="close closeUpdate">&times;</span>
                    <h2>Modifier une Catégorie</h2>
                    <form method="POST" action="index.php?controller=Admin&action=updateCategory" enctype="multipart/form-data" class="form-update-admin">
                        <input type="hidden" id="edit_id_categorie" name="id_categorie">
                        <label for="edit_nom_categorie">Nom :</label>
                        <input type="text" id="edit_nom_categorie" name="nom" required>
                        <label for="edit_description_categorie">Description :</label>
                        <textarea id="edit_description_categorie" name="description"></textarea>
                        <label for="edit_photo_categorie">Photo :</label>
                        <input type="file" name="photo" id="edit_photo_categorie">
                        <button type="submit">Modifier</button>
                    </form>
                </div>
            </div>

            <ul id="categories-list">
                <?php foreach ($options['categories'] as $categorie): ?>
                    <li>
                        <?= htmlspecialchars($categorie['nom']) ?>
                        <?php if ($categorie['photo']): ?>
                            <img src="<?= htmlspecialchars($categorie['photo']) ?>" alt="Image de la catégorie">
                        <?php else: ?>
                            <p>Aucune image disponible</p>
                        <?php endif; ?>
                        <p><?= htmlspecialchars($categorie['description']) ?></p>
                        <button class="btn-edit"
                            data-type="categorie"
                            data-id="<?= $categorie['id_categorie'] ?>"
                            data-nom="<?= htmlspecialchars($categorie['nom'], ENT_QUOTES) ?>"
                            data-description="<?= htmlspecialchars($categorie['description'], ENT_QUOTES) ?>">
                            Modifier
                        </button>
                        <a href="index.php?controller=Admin&action=deleteCategory&id_categorie=<?= $categorie['id_categorie'] ?>">Supprimer</a>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>

        <!-- MODELES -->
        <div class="accordion-content-admin">
            <p id="statusMessageModele" style="text-align: center; color: darkgoldenrod"></p>
            <button class="openModalBtn">Ajouter un Modèle</button>

            <!-- Modal CREATE -->
            <div class="modal modalsAdmin">
                <div class="modal-content">
                    <span class="close">&times;</span>
                    <h2>Ajouter un Modèle</h2>
                    <form method="POST" action="index.php?controller=Admin&action=createModele" class="form-cars-create" id="formModele">
                        <label for="nom">Nom du modèle :</label>
                        <input type="text" id="nom" name="nom" required>
                        <button type="submit">Créer</button>
                    </form>
                </div>
            </div>

            <!-- Modal UPDATE -->
            <div class="modal modalUpdate" id="modalUpdateModele">
                <div class="modal-content">
                    <span class="close closeUpdate">&times;</span>
                    <h2>Modifier un Modèle</h2>
                    <form method="POST" action="index.php?controller=Admin&action=updateModele" class="form-update-admin">
                        <input type="hidden" id="edit_id_modele" name="id_modele">
                        <label for="edit_nom_modele">Nom du modèle :</label>
                        <input type="text" id="edit_nom_modele" name="nom" required>
                        <button type="submit">Modifier</button>
                    </form>
                </div>
            </div>

            <ul id="modele-list">
                <?php foreach ($options['modeles'] as $modele): ?>
                    <li>
                        <?= htmlspecialchars($modele['nom']) ?>
                        <button class="btn-edit"
                            data-type="modele"
                            data-id="<?= $modele['id_modele'] ?>"
                            data-nom="<?= htmlspecialchars($modele['nom'], ENT_QUOTES) ?>">
                            Modifier
                        </button>
                        <a href="index.php?controller=Admin&action=deleteModele&id_modele=<?= $modele['id_modele'] ?>">Supprimer</a>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>


        <!-- MARQUES -->
        <div class="accordion-content-admin">
            <p id="statusMessageMarque" style="text-align: center; color: darkgoldenrod"></p>
            <button class="openModalBtn">Ajouter une Marque</button>

            <!-- Modal CREATE -->
            <div class="modal modalsAdmin">
                <div class="modal-content">
                    <span class="close">&times;</span>
                    <h2>Ajouter une Marque</h2>
                    <form method="POST" action="index.php?controller=Admin&action=createMarque" class="form-cars-create" id="formMarque">
                        <label for="marque_nom">Nom de la marque :</label>
                        <input type="text" id="marque_nom" name="nom" required>
                        <button type="submit">Créer</button>
                    </form>
                </div>
            </div>

            <!-- Modal UPDATE -->
            <div class="modal modalUpdate" id="modalUpdateMarque">
                <div class="modal-content">
                    <span class="close closeUpdate">&times;</span>
                    <h2>Modifier une Marque</h2>
                    <form method="POST" action="index.php?controller=Admin&action=updateMarque" class="form-update-admin">
                        <input type="hidden" id="edit_id_marque" name="id_marque">
                        <label for="edit_nom_marque">Nom de la marque :</label>
                        <input type="text" id="edit_nom_marque" name="nom" required>
                        <button type="submit">Modifier</button>
                    </form>
                </div>
            </div>

            <ul id="marque-list">
                <?php foreach ($options['marques'] as $marque): ?>
                    <li>
                        <?= htmlspecialchars($marque['nom']) ?>
                        <button class="btn-edit"
                            data-type="marque"
                            data-id="<?= $marque['id_marque'] ?>"
                            data-nom="<?= htmlspecialchars($marque['nom'], ENT_QUOTES) ?>">
                            Modifier
                        </button>
                        <a href="index.php?controller=Admin&action=deleteMarque&id_marque=<?= $marque['id_marque'] ?>">Supprimer</a>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>


        <!-- CARBURANTS -->
        <div class="accordion-content-admin">
            <p id="statusMessageCarburant" style="text-align: center; color: darkgoldenrod"></p>
            <button class="openModalBtn">Ajouter un Carburant</button>

            <!-- Modal CREATE -->
            <div class="modal modalsAdmin">
                <div class="modal-content">
                    <span class="close">&times;</span>
                    <h2>Ajouter un Carburant</h2>
                    <form method="POST" action="index.php?controller=Admin&action=createCarburant" class="form-cars-create" id="formCarburant">
                        <label for="carburant_nom">Type de carburant :</label>
                        <input type="text" id="carburant_nom" name="type" required>
                        <button type="submit">Créer</button>
                    </form>
                </div>
            </div>

            <!-- Modal UPDATE -->
            <div class="modal modalUpdate" id="modalUpdateCarburant">
                <div class="modal-content">
                    <span class="close closeUpdate">&times;</span>
                    <h2>Modifier un Carburant</h2>
                    <form method="POST" action="index.php?controller=Admin&action=updateCarburant" class="form-update-admin">
                        <input type="hidden" id="edit_id_carburant" name="id_carburant">
                        <label for="edit_type_carburant">Type de carburant :</label>
                        <input type="text" id="edit_type_carburant" name="type" required>
                        <button type="submit">Modifier</button>
                    </form>
                </div>
            </div>

            <ul id="carburant-list">
                <?php foreach ($options['carburants'] as $carburant): ?>
                    <li>
                        <?= htmlspecialchars($carburant['type']) ?>
                        <button class="btn-edit"
                            data-type="carburant"
                            data-id="<?= $carburant['id_carburant'] ?>"
                            data-carburant="<?= htmlspecialchars($carburant['type'], ENT_QUOTES) ?>">
                            Modifier
                        </button>
                        <a href="index.php?controller=Admin&action=deleteCarburant&id_carburant=<?= $carburant['id_carburant'] ?>">Supprimer</a>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>


        <!-- TRANSMISSIONS -->
        <div class="accordion-content-admin">
            <p id="statusMessageTransmission" style="text-align: center; color: darkgoldenrod"></p>
            <button class="openModalBtn">Ajouter une Transmission</button>

            <!-- Modal CREATE -->
            <div class="modal modalsAdmin">
                <div class="modal-content">
                    <span class="close">&times;</span>
                    <h2>Ajouter une Transmission</h2>
                    <form method="POST" action="index.php?controller=Admin&action=createTransmission" class="form-cars-create" id="formTransmission">
                        <label for="transmission_nom">Type de transmission :</label>
                        <input type="text" id="transmission_nom" name="type" required>
                        <button type="submit">Créer</button>
                    </form>
                </div>
            </div>

            <!-- Modal UPDATE -->
            <div class="modal modalUpdate" id="modalUpdateTransmission">
                <div class="modal-content">
                    <span class="close closeUpdate">&times;</span>
                    <h2>Modifier une Transmission</h2>
                    <form method="POST" action="index.php?controller=Admin&action=updateTransmission" class="form-update-admin">
                        <input type="hidden" id="edit_id_transmission" name="id_transmission">
                        <label for="edit_type_transmission">Type de transmission :</label>
                        <input type="text" id="edit_type_transmission" name="type" required>
                        <button type="submit">Modifier</button>
                    </form>
                </div>
            </div>

            <ul id="transmission-list">
                <?php foreach ($options['transmissions'] as $transmission): ?>
                    <li>
                        <?= htmlspecialchars($transmission['type']) ?>
                        <button class="btn-edit"
                            data-type="transmission"
                            data-id="<?= $transmission['id_transmission'] ?>"
                            data-transmission="<?= htmlspecialchars($transmission['type'], ENT_QUOTES) ?>">
                            Modifier
                        </button>
                        <a href="index.php?controller=Admin&action=deleteTransmission&id_transmission=<?= $transmission['id_transmission'] ?>">Supprimer</a>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>


        <!-- PLACES -->
        <div class="accordion-content-admin">
            <p id="statusMessagePlaces" style="text-align: center; color: darkgoldenrod"></p>
            <button class="openModalBtn">Ajouter un Nombre de places</button>

            <!-- Modal CREATE -->
            <div class="modal modalsAdmin">
                <div class="modal-content">
                    <span class="close">&times;</span>
                    <h2>Ajouter un Nombre de places</h2>
                    <form method="POST" action="index.php?controller=Admin&action=createPlaces" class="form-cars-create" id="formPlaces">
                        <label for="places_nombre">Nombre de places :</label>
                        <input type="number" id="places_nombre" name="nombre" required>
                        <button type="submit">Créer</button>
                    </form>
                </div>
            </div>

            <!-- Modal UPDATE -->
            <div class="modal modalUpdate" id="modalUpdatePlaces">
                <div class="modal-content">
                    <span class="close closeUpdate">&times;</span>
                    <h2>Modifier le Nombre de places</h2>
                    <form method="POST" action="index.php?controller=Admin&action=updatePlaces" class="form-update-admin">
                        <input type="hidden" id="edit_id_places" name="id_places">
                        <label for="edit_nombre_places">Nombre de places :</label>
                        <input type="number" id="edit_nombre_places" name="nombre" required>
                        <button type="submit">Modifier</button>
                    </form>
                </div>
            </div>

            <ul id="place-list">
                <?php foreach ($options['places'] as $place): ?>
                    <li>
                        <?= htmlspecialchars($place['nombre']) ?>
                        <button class="btn-edit"
                            data-type="places"
                            data-id="<?= $place['id_places'] ?>"
                            data-nombre="<?= htmlspecialchars($place['nombre'], ENT_QUOTES) ?>">
                            Modifier
                        </button>
                        <a href="index.php?controller=Admin&action=deletePlaces&id_places=<?= $place['id_places'] ?>">Supprimer</a>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>

        <!-- COULEURS -->
        <div class="accordion-content-admin">
            <p id="statusMessageCouleur" style="text-align: center; color: darkgoldenrod"></p>
            <button class="openModalBtn">Ajouter une Couleur</button>

            <!-- Modal CREATE -->
            <div class="modal modalsAdmin">
                <div class="modal-content">
                    <span class="close">&times;</span>
                    <h2>Ajouter une Couleur</h2>
                    <form method="POST" action="index.php?controller=Admin&action=createCouleur" class="form-cars-create" id="formCouleur">
                        <label for="couleur_nom">Nom de la couleur :</label>
                        <input type="text" id="couleur_nom" name="nom" required>
                        <button type="submit">Créer</button>
                    </form>
                </div>
            </div>

            <!-- Modal UPDATE -->
            <div class="modal modalUpdate" id="modalUpdateCouleur">
                <div class="modal-content">
                    <span class="close closeUpdate">&times;</span>
                    <h2>Modifier la Couleur</h2>
                    <form method="POST" action="index.php?controller=Admin&action=updateCouleur" class="form-update-admin">
                        <input type="hidden" id="edit_id_couleur" name="id_couleur">
                        <label for="edit_nom_couleur">Nom de la couleur :</label>
                        <input type="text" id="edit_nom_couleur" name="nom" required>
                        <button type="submit">Modifier</button>
                    </form>
                </div>
            </div>

            <ul id="couleur-list">
                <?php foreach ($options['couleurs'] as $couleur): ?>
                    <li>
                        <?= htmlspecialchars($couleur['nom']) ?>
                        <button class="btn-edit"
                            data-type="couleur"
                            data-id="<?= $couleur['id_couleur'] ?>"
                            data-nom-couleur="<?= htmlspecialchars($couleur['nom'], ENT_QUOTES) ?>">
                            Modifier
                        </button>
                        <a href="index.php?controller=Admin&action=deleteCouleur&id_couleur=<?= $couleur['id_couleur'] ?>">Supprimer</a>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>

    </div>

    <?php $scripts = ["admin/addOptions", "accordeonsMenu", "modals", "admin/updateOptions"]; ?>