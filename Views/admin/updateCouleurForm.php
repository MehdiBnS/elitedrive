<h2>Modifier une couleur</h2>

<form method="POST" action="index.php?controller=Admin&action=updateCouleur" class="form-update-admin">

    <div class="form-group-admin">
        <label for="id_couleur" class="form-label-admin">ID couleur :</label>
        <input type="hidden" id="id_couleur" name="id_couleur" class="form-input-admin" value="<?= $couleur->id_couleur ?>">
    </div>

    <div class="form-group-admin">
        <label for="nom" class="form-label-admin">Nom de la couleur :</label>
        <input type="text" id="nom" name="nom" class="form-input-admin" value="<?= htmlspecialchars($couleur->nom) ?>" required>
    </div>

    <div class="form-group-admin">
        <button type="submit" class="form-button-admin">Modifier</button>
        <a href="index.php?controller=Admin&action=orderOptions">Retour</a>
    </div>

</form>
