<section id="car-section">
    <a id="filter-menu" href="#"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-filter-circle-fill" viewBox="0 0 16 16">
            <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16M3.5 5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1 0-1M5 8.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5m2 3a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5" />
        </svg></a>
    <div id="container-filter">
        <!-- FORMULAIRE DE RECHERCHE -->
        <a id="filter-none" href="#">Fermer</a>


        <form method="GET" action="index.php?controller=Vehicule&action=showCar" id="search-form">
            <label for="search-filter" class="filter-label">
                <input type="text" name="search" id="search-filter" placeholder="Rechercher un véhicule" class="filter-input">
                <button type="submit" class="filter-button">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                        <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0" />
                    </svg>
                </button>
            </label>

            <!-- Marque -->
            <select name="marque" id="marque-filter" class="filter-select">
                <option value="">Sélectionner une marque</option>
                <?php foreach ($options['marques'] as $option) : ?>
                    <option value="<?= $option['id_marque'] ?>"><?= htmlspecialchars($option['nom']) ?></option>
                <?php endforeach; ?>
            </select>

            <!-- Modèle -->
            <select name="modele" id="modele-filter" class="filter-select">
                <option value="">Sélectionner un modèle</option>
                <?php foreach ($options['modeles'] as $option) : ?>
                    <option value="<?= $option['id_modele'] ?>"><?= htmlspecialchars($option['nom']) ?></option>
                <?php endforeach; ?>
            </select>

            <!-- Catégorie -->
            <select name="categorie" id="categorie-filter" class="filter-select">
                <option value="">Sélectionner une catégorie</option>
                <?php foreach ($options['categories'] as $option) : ?>
                    <option value="<?= $option['id_categorie'] ?>"><?= htmlspecialchars($option['nom']) ?></option>
                <?php endforeach; ?>
            </select>

            <!-- Carburant -->
            <div class="checkbox-contain">
                <div class="checkbox-group">
                    <label class="checkbox-label">Carburant :</label>
                    <?php foreach ($options['carburants'] as $option) : ?>
                        <label>
                            <input type="checkbox" name="carburant[]" value="<?= $option['id_carburant'] ?>" class="checkbox-input">
                            <?= htmlspecialchars($option['type']) ?>
                        </label>
                    <?php endforeach; ?>
                </div>

                <div class="checkbox-group">
                    <label class="checkbox-label">Transmission :</label>
                    <?php foreach ($options['transmissions'] as $option) : ?>
                        <label>
                            <input type="checkbox" name="transmission[]" value="<?= $option['id_transmission'] ?>" class="checkbox-input">
                            <?= htmlspecialchars($option['type']) ?>
                        </label>
                    <?php endforeach; ?>
                </div>
            </div>

            <!-- Couleur -->
            <select name="couleur" id="couleur-filter" class="filter-select">
                <option value="">Sélectionner une couleur</option>
                <?php foreach ($options['couleurs'] as $option) : ?>
                    <option value="<?= $option['id_couleur'] ?>"><?= htmlspecialchars($option['nom']) ?></option>
                <?php endforeach; ?>
            </select>

            <!-- Transmission -->


            <!-- Nombre de places -->
            <select name="places" id="places-filter" class="filter-select">
                <option value="">Sélectionner le nombre de places</option>
                <?php foreach ($options['places'] as $option) : ?>
                    <option value="<?= $option['id_places'] ?>"><?= htmlspecialchars($option['nombre']) ?></option>
                <?php endforeach; ?>
            </select>

            <div>
                <button type="submit" class="filter-button" id="btn-carac">
                    Filtrer
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-filter" viewBox="0 0 16 16">
                        <path d="M6 10.5a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 0 1h-3a.5.5 0 0 1-.5-.5m-2-3a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5m-2-3a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5" />
                    </svg>
                </button>
            </div>
        </form>
    </div>


    <div id="car-list">
        <h1>Nos véhicules</h1>

        <div id="nav-car">
            <a href="index.php?controller=Vehicule&action=showCar">Voir tous</a>
            <a href="index.php?controller=Vehicule&action=showCar&tri=nouveaute">Nouveauté</a>
            <a href="index.php?controller=Vehicule&action=showCar&tri=prix_asc">Prix croissant</a>
            <a href="index.php?controller=Vehicule&action=showCar&tri=prix_desc">Prix décroissant</a>
        </div>


        <!-- CATEGORIES CLIQUABLES -->
        <div id="category-container">
            <?php if (!empty($categorie)) : ?>
                <?php foreach ($categorie as $categories) : ?>
                    <div class="category-item" id="category-<?= $categories->id_categorie ?>">
                        <a href="index.php?controller=Vehicule&action=showCar&id_categorie=<?= $categories->id_categorie ?>" class="category-link">
                            <div class="category-image-container">
                                <img src="<?= htmlspecialchars($categories->photo) ?>" alt="<?= htmlspecialchars($categories->nom) ?>" class="category-image">
                                <h2 class="category-title">Voir nos <?= htmlspecialchars($categories->nom) ?></h2>
                            </div>
                        </a>
                    </div>
                <?php endforeach; ?>
            <?php else : ?>
                <p>Aucune catégorie trouvée</p>
            <?php endif; ?>
        </div>
        <!-- VEHICULES PAR CATEGORIE -->
        <?php if (!empty($vehiculeCategorie) && isset($_GET['id_categorie'])) : ?>
            <div id="vehicule-section">
                <h2>Résultats pour la catégorie sélectionnée :</h2>

                <!-- Liste des véhicules -->
                <div class="liste-car">
                    <?php foreach ($vehiculeCategorie as $vehicule) : ?>
                        <div class="vehicule-card<?= ($vehicule->statut === 'Maintenance') ? ' maintenance-vehicule-card' : '' ?>">

                            <?php if ($vehicule->photo != null) : ?>
                                <img src="<?= htmlspecialchars($vehicule->photo) ?>" alt="<?= htmlspecialchars($vehicule->nom) ?>" width="200">
                            <?php else : ?>
                                <p>Aucune photo</p>
                            <?php endif; ?>
                            <h3><?= htmlspecialchars($vehicule->nom) ?></h3>
                            <h4><?= htmlspecialchars($vehicule->annee) ?></h4>
                            <p>A partir de <?= htmlspecialchars($vehicule->prix_km) ?>€/KM</p>
                            <small style="font-style: italic;"> <?= htmlspecialchars($vehicule->statut) ?> </small><br>

                            <?php if (isset($notesByVehicule[$vehicule->id_vehicule])) : ?>
                                <div class="note-stars">
                                    <?php
                                    $noteMoyenne = round($notesByVehicule[$vehicule->id_vehicule]);
                                    for ($i = 1; $i <= 5; $i++) {
                                        if ($i <= $noteMoyenne) {
                                            // étoile dorée
                                            echo '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="darkgoldenrod" class="bi bi-star-fill" viewBox="0 0 16 16">
                        <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                      </svg>';
                                        } else {
                                            // étoile grise
                                            echo '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#e0e0e0" class="bi bi-star-fill" viewBox="0 0 16 16">
                        <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                      </svg>';
                                        }
                                    }
                                    ?>
                                    <span style="margin-left: 5px; font-size: 14px; color: #666;"><?= $noteMoyenne ?>/5</span>
                                </div>
                            <?php else : ?>
                                <?php for ($i = 1; $i <= 5; $i++) : ?>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#e0e0e0" class="bi bi-star-fill" viewBox="0 0 16 16">
                                        <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z" />
                                    </svg>
                                <?php endfor; ?>
                                <span style="margin-left: 5px; font-size: 14px; color: #666;">0/5</span>
                            <?php endif; ?>

                            <a href="index.php?controller=Vehicule&action=showCarOne&id_vehicule=<?= $vehicule->id_vehicule ?>">Plus d'infos</a>
                        </div>
                    <?php endforeach; ?>
                </div>

                <div id="back-btn">
                    <a href="index.php?controller=Vehicule&action=showCar" class="btn-back">Revenir à la liste complète</a>
                </div>
            </div>

        <?php elseif (isset($_GET['id_categorie'])) : ?>
            <div id="vehicule-section">
                <p id="msg-category">Aucun véhicule trouvé pour cette catégorie.</p>

            </div>

        <?php endif; ?>

        <?php if (empty($vehiculeCategorie) && !empty($vehiculeSearch)) : ?>
            <h2>Résultats pour la recherche :</h2>
            <div id="vehicule-section">
                <div class="liste-car">

                    <?php foreach ($vehiculeSearch as $vehiculeFind) : ?>
                        <div class="vehicule-card<?= ($vehiculeFind['statut'] === 'Maintenance') ? ' maintenance-vehicule-card' : '' ?>">

                            <?php if (!empty($vehiculeFind['photo'])) : ?>
                                <img src="<?= htmlspecialchars($vehiculeFind['photo']) ?>" alt="<?= htmlspecialchars($vehiculeFind['nom']) ?>" width="200">
                            <?php else : ?>
                                <p>Aucune photo</p>
                            <?php endif; ?>
                            <h3><?= htmlspecialchars($vehiculeFind['nom'] ?? 'Nom indisponible') ?></h3>
                            <h4><?= htmlspecialchars($vehiculeFind['annee'] ?? 'Année indisponible') ?></h4>
                            <p>A partir de <?= htmlspecialchars($vehiculeFind['prix_km'] ?? 'Prix indisponible') ?>€/KM</p>
                            <small style="font-style: italic;"> <?= htmlspecialchars($vehiculeFind['statut']) ?> </small><br>
                            <small style="font-style:italic; color: grey">Les notes sont afficher sur la page du véhicule</small>

                            <a href="index.php?controller=Vehicule&action=showCarOne&id_vehicule=<?= $vehiculeFind['id_vehicule'] ?>">Plus d'infos</a>
                        </div>
                    <?php endforeach; ?>
                </div>

            </div>

            <!-- Bouton de retour -->
            <div id="back-btn">
                <a href="index.php?controller=Vehicule&action=showCar" class="btn-back">Revenir à la liste complète</a>
            </div>
        <?php endif; ?>


        <?php if (empty($vehiculeCategorie) && !empty($vehicule)) : ?>
            <h2>Véhicules disponibles :</h2>
            <div id="vehicule-section">
                <div class="liste-car">
                    <?php foreach ($vehicule as $vehicules) : ?>
                        <div class="vehicule-card<?= ($vehicules->statut === 'Maintenance') ? ' maintenance-vehicule-card' : '' ?>">


                            <?php if ($vehicules->photo != null) : ?>
                                <img src="<?= htmlspecialchars($vehicules->photo) ?>" alt="<?= htmlspecialchars($vehicules->nom) ?>" width="200">
                            <?php else : ?>
                                <p>Aucune photo</p>
                            <?php endif; ?>

                            <h3><?= htmlspecialchars($vehicules->nom) ?></h3>
                            <h4><?= htmlspecialchars($vehicules->annee) ?></h4>
                            <p>A partir de <?= htmlspecialchars($vehicules->prix_km) ?>€/KM</p>
                            <small style="font-style: italic;"> <?= htmlspecialchars($vehicules->statut) ?> </small>

                            <div class="note-stars">
                                <?php if (isset($notesByVehicule[$vehicules->id_vehicule])) : ?>
                                    <?php
                                    $noteMoyenne = round($notesByVehicule[$vehicules->id_vehicule]);
                                    for ($i = 1; $i <= 5; $i++) {
                                        if ($i <= $noteMoyenne) {
                                            // étoile dorée
                                            echo '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="darkgoldenrod" class="bi bi-star-fill" viewBox="0 0 16 16">
                                <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                            </svg>';
                                        } else {
                                            // étoile grise
                                            echo '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#e0e0e0" class="bi bi-star-fill" viewBox="0 0 16 16">
                                <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                            </svg>';
                                        }
                                    }
                                    ?>
                                    <span style="margin-left: 5px; font-size: 14px; color: #666;"><?= $noteMoyenne ?>/5</span>
                                <?php else : ?>
                                    <?php for ($i = 1; $i <= 5; $i++) : ?>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#e0e0e0" class="bi bi-star-fill" viewBox="0 0 16 16">
                                            <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z" />
                                        </svg>
                                    <?php endfor; ?>
                                    <span style="margin-left: 5px; font-size: 14px; color: #666;">0/5</span>
                                <?php endif; ?>
                            </div>

                            <a href="index.php?controller=Vehicule&action=showCarOne&id_vehicule=<?= $vehicules->id_vehicule ?>">Plus d'infos</a>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php elseif (empty($vehiculeCategorie) && empty($vehicule) && empty($vehiculeSearch)) : ?>
                <div id="vehicule-section">
                    <p>Aucun véhicule trouvé.</p>
                    <div id="back-btn">
                        <a href="index.php?controller=Vehicule&action=showCar" class="btn-back">Revenir à la liste complète</a>
                    </div>
                </div>
            <?php endif; ?>




            </div>

    </div>


</section>