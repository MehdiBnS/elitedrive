<h2>Modifier une archive</h2>

<form method="POST" action="index.php?controller=Admin&action=updateArchive" enctype="multipart/form-data" class="form-update-admin">

    <div class="left-form-admin">
        <input type="hidden" name="id_archive" value="<?= htmlspecialchars($archive->id_archive) ?>">

        <div class="form-group-admin">
            <label for="nom" class="form-label-admin">Nom :</label>
            <input type="text" id="nom" name="nom" class="form-input-admin" value="<?= htmlspecialchars($archive->nom) ?>" required>
        </div>

        <div class="form-group-admin">
            <label for="prenom" class="form-label-admin">Prénom :</label>
            <input type="text" id="prenom" name="prenom" class="form-input-admin" value="<?= htmlspecialchars($archive->prenom) ?>" required>
        </div>

        <div class="form-group-admin">
            <label for="numero_telephone" class="form-label-admin">Téléphone :</label>
            <input type="text" id="numero_telephone" name="numero_telephone" class="form-input-admin" value="<?= htmlspecialchars($archive->numero_telephone) ?>" required>
        </div>

        <div class="form-group-admin">
            <label for="ville" class="form-label-admin">Ville :</label>
            <input type="text" id="ville" name="ville" class="form-input-admin" value="<?= htmlspecialchars($archive->ville) ?>" required>
        </div>

        <div class="form-group-admin">
            <label for="email" class="form-label-admin">Email :</label>
            <input type="email" id="email" name="email" class="form-input-admin" value="<?= htmlspecialchars($archive->email) ?>" required>
        </div>

        <div class="form-group-admin">
            <label for="nom_vehicule" class="form-label-admin">Nom du véhicule :</label>
            <input type="text" id="nom_vehicule" name="nom_vehicule" class="form-input-admin" value="<?= htmlspecialchars($archive->nom_vehicule) ?>" required>
        </div>

        <div class="form-group-admin">
            <label for="modele" class="form-label-admin">Modèle :</label>
            <input type="text" id="modele" name="modele" class="form-input-admin" value="<?= htmlspecialchars($archive->modele) ?>" required>
        </div>
    </div>

    <div class="right-form-admin">
        <div class="form-group-admin">
            <label for="marque" class="form-label-admin">Marque :</label>
            <input type="text" id="marque" name="marque" class="form-input-admin" value="<?= htmlspecialchars($archive->marque) ?>" required>
        </div>

        <div class="form-group-admin">
            <label for="categorie_vehicule" class="form-label-admin">Catégorie :</label>
            <input type="text" id="categorie_vehicule" name="categorie_vehicule" class="form-input-admin" value="<?= htmlspecialchars($archive->categorie_vehicule) ?>" required>
        </div>

        <div class="form-group-admin">
            <label for="montant" class="form-label-admin">Montant (€) :</label>
            <input type="number" step="0.01" id="montant" name="montant" class="form-input-admin" value="<?= htmlspecialchars($archive->montant) ?>" required>
        </div>

        <div class="form-group-admin">
            <label for="date" class="form-label-admin">Date :</label>
            <input type="date" id="date" name="date" class="form-input-admin" value="<?= htmlspecialchars($archive->date) ?>" required>
        </div>

        <div class="form-group-admin">
            <button type="submit" class="form-button-admin">Modifier</button>
        </div>
    </div>

</form>

<a href="index.php?controller=Admin&action=orderArchives">Retour</a>
