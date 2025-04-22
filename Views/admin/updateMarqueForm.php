<h2>Modifier une marque</h2>

<form method="POST" action="index.php?controller=Admin&action=updateMarque" class="form-update-admin">

    <div class="form-group-admin">
        <label for="id_marque" class="form-label-admin">ID marque :</label>
        <input type="hidden" id="id_marque" name="id_marque" class="form-input-admin" value="<?= $marque->id_marque ?>">
    </div>

    <div class="form-group-admin">
        <label for="nom" class="form-label-admin">Nom de la marque :</label>
        <input type="text" id="nom" name="nom" class="form-input-admin" value="<?= htmlspecialchars($marque->nom) ?>" required>
    </div>

    <div class="form-group-admin">
        <button type="submit" class="form-button-admin">Modifier</button>
        <a href="index.php?controller=Admin&action=orderOptions">Retour</a>
    </div>

</form>
