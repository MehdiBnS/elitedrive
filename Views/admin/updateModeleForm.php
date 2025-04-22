<h2>Modifier un modèle</h2>

<form method="POST" action="index.php?controller=Admin&action=updateModele" class="form-update-admin">

    <div class="form-group-admin">
        <label for="id_modele" class="form-label-admin">ID modèle :</label>
        <input type="hidden" id="id_modele" name="id_modele" class="form-input-admin" value="<?= $modele->id_modele ?>">
    </div>

    <div class="form-group-admin">
        <label for="nom" class="form-label-admin">Nom du modèle :</label>
        <input type="text" id="nom" name="nom" class="form-input-admin" value="<?= htmlspecialchars($modele->nom) ?>" required>
    </div>

    <div class="form-group-admin">
        <button type="submit" class="form-button-admin">Modifier</button>
        <a href="index.php?controller=Admin&action=orderOptions">Retour</a>
    </div>

</form>
