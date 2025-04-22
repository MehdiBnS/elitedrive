<h2>Modifier un véhicule</h2>

<form method="POST" action="index.php?controller=Admin&action=updateCar" enctype="multipart/form-data" class="form-update-admin">

    <input type="hidden" id="id_vehicule" name="id_vehicule" value="<?= $vehicule->id_vehicule ?>" readonly>

    <div class="form-group-admin">
        <label for="nom" class="form-label-admin">Nom du véhicule :</label>
        <input type="text" id="nom" name="nom" class="form-input-admin" value="<?= htmlspecialchars($vehicule->nom ?? '') ?>" required readonly>
    </div>

    <div class="form-group-admin">
        <label for="prix_km" class="form-label-admin">Prix au km :</label>
        <input type="number" step="0.01" id="prix_km" name="prix_km" class="form-input-admin" value="<?= htmlspecialchars($vehicule->prix_km) ?>" required>
    </div>

    <div class="form-group-admin">
        <label for="prix_jour" class="form-label-admin">Prix par jour :</label>
        <input type="number" step="0.01" id="prix_jour" name="prix_jour" class="form-input-admin" value="<?= htmlspecialchars($vehicule->prix_jour) ?>" required>
    </div>

    <div class="form-group-admin">
        <label for="prix_semaine" class="form-label-admin">Prix par semaine :</label>
        <input type="number" step="0.01" id="prix_semaine" name="prix_semaine" class="form-input-admin" value="<?= htmlspecialchars($vehicule->prix_semaine) ?>">
    </div>

    <div class="form-group-admin">
        <label for="prix_mois" class="form-label-admin">Prix par mois :</label>
        <input type="number" step="0.01" id="prix_mois" name="prix_mois" class="form-input-admin" value="<?= htmlspecialchars($vehicule->prix_mois) ?>">
    </div>

    <div class="form-group-admin">
        <label for="annee" class="form-label-admin">Année :</label>
        <input type="number" id="annee" name="annee" class="form-input-admin" value="<?= htmlspecialchars($vehicule->annee) ?>" required>
    </div>

    <div class="form-group-admin">
        <label for="description" class="form-label-admin">Description :</label>
        <textarea id="description" name="description" class="form-input-admin" required><?= htmlspecialchars($vehicule->description) ?></textarea>
    </div>

    <div class="form-group-admin">
        <label for="statut" class="form-label-admin">Statut :</label>
        <select id="statut" name="statut" class="form-input-admin">
            <option value="Disponible" <?= $vehicule->statut == 'Disponible' ? 'selected' : '' ?>>Disponible</option>
            <option value="Réserver" <?= $vehicule->statut == 'Réserver' ? 'selected' : '' ?>>Réserver</option>
            <option value="Loué" <?= $vehicule->statut == 'Loué' ? 'selected' : '' ?>>Loué</option>
            <option value="Maintenance" <?= $vehicule->statut == 'Maintenance' ? 'selected' : '' ?>>Maintenance</option>
        </select>
    </div>

    <!-- Modèle -->
    <?php if (!empty($options['modeles'])): ?>
        <div class="form-group-admin">
            <label for="id_modele" class="form-label-admin">Modèle :</label>
            <select id="id_modele" name="id_modele" class="form-input-admin">
                <?php foreach ($options['modeles'] as $option): ?>
                    <option value="<?= $option['id_modele']; ?>" <?= $vehicule->id_modele == $option['id_modele'] ? 'selected' : '' ?>>
                        <?= htmlspecialchars($option['nom']); ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
    <?php endif; ?>

    <!-- Marque -->
    <?php if (!empty($options['marques'])): ?>
        <div class="form-group-admin">
            <label for="id_marque" class="form-label-admin">Marque :</label>
            <select id="id_marque" name="id_marque" class="form-input-admin">
                <?php foreach ($options['marques'] as $option): ?>
                    <option value="<?= $option['id_marque']; ?>" <?= $vehicule->id_marque == $option['id_marque'] ? 'selected' : '' ?>>
                        <?= htmlspecialchars($option['nom']); ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
    <?php endif; ?>

    <!-- Carburant -->
    <?php if (!empty($options['carburants'])): ?>
        <div class="form-group-admin">
            <label for="id_carburant" class="form-label-admin">Carburant :</label>
            <select id="id_carburant" name="id_carburant" class="form-input-admin">
                <?php foreach ($options['carburants'] as $option): ?>
                    <option value="<?= $option['id_carburant']; ?>" <?= $vehicule->id_carburant == $option['id_carburant'] ? 'selected' : '' ?>>
                        <?= htmlspecialchars($option['type']); ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
    <?php endif; ?>

    <!-- Transmission -->
    <?php if (!empty($options['transmissions'])): ?>
        <div class="form-group-admin">
            <label for="id_transmission" class="form-label-admin">Transmission :</label>
            <select id="id_transmission" name="id_transmission" class="form-input-admin">
                <?php foreach ($options['transmissions'] as $option): ?>
                    <option value="<?= $option['id_transmission']; ?>" <?= $vehicule->id_transmission == $option['id_transmission'] ? 'selected' : '' ?>>
                        <?= htmlspecialchars($option['type']); ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
    <?php endif; ?>

    <!-- Nombre de places -->
    <?php if (!empty($options['places'])): ?>
        <div class="form-group-admin">
            <label for="id_places" class="form-label-admin">Nombre de places :</label>
            <select id="id_places" name="id_places" class="form-input-admin">
                <?php foreach ($options['places'] as $option): ?>
                    <option value="<?= $option['id_places']; ?>" <?= $vehicule->id_places == $option['id_places'] ? 'selected' : '' ?>>
                        <?= htmlspecialchars($option['nombre']); ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
    <?php endif; ?>

    <!-- Couleur -->
    <?php if (!empty($options['couleurs'])): ?>
        <div class="form-group-admin">
            <label for="id_couleur" class="form-label-admin">Couleur :</label>
            <select id="id_couleur" name="id_couleur" class="form-input-admin">
                <?php foreach ($options['couleurs'] as $option): ?>
                    <option value="<?= $option['id_couleur']; ?>" <?= $vehicule->id_couleur == $option['id_couleur'] ? 'selected' : '' ?>>
                        <?= htmlspecialchars($option['nom']); ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
    <?php endif; ?>

    <!-- Catégorie -->
    <?php if (!empty($options['categories'])): ?>
        <div class="form-group-admin">
            <label for="id_categorie" class="form-label-admin">Catégorie :</label>
            <select id="id_categorie" name="id_categorie" class="form-input-admin">
                <?php foreach ($options['categories'] as $option): ?>
                    <option value="<?= $option['id_categorie']; ?>" <?= $vehicule->id_categorie == $option['id_categorie'] ? 'selected' : '' ?>>
                        <?= htmlspecialchars($option['nom']); ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
    <?php endif; ?>

    <div class="form-group-admin">
        <label for="photo" class="form-label-admin">Photo :</label>
        <input type="file" id="photo" name="photo" class="form-input-admin">
        <?php if ($vehicule->photo != null) : ?>
            <img src="<?= htmlspecialchars($vehicule->photo) ?>" alt="Photo Actuelle">
            <p> Photo du véhicule </p>
        <?php else : ?>
            <p>Pas encore de photo</p>
        <?php endif; ?>
    </div>

    <div class="form-group-admin">
        <button type="submit">Modifier</button>
        <a href="index.php?controller=Admin&action=orderCars">Retour</a>
    </div>
</form>