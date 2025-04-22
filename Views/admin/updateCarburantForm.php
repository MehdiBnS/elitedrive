<h2>Modifier le type de carburant</h2>

<form method="POST" action="index.php?controller=Admin&action=updateCarburant" class="form-update-admin">

    <div class="form-group-admin">
        <label for="id_carburant" class="form-label-admin">ID carburant :</label>
        <input type="hidden" id="id_carburant" name="id_carburant" class="form-input-admin" value="<?= $carburant->id_carburant ?>">
    </div>

    <div class="form-group-admin">
        <label for="type" class="form-label-admin">Type de carburant :</label>
        <input type="text" id="type" name="type" class="form-input-admin" value="<?= htmlspecialchars($carburant->type) ?>" required>
    </div>

    <div class="form-group-admin">
        <button type="submit" class="form-button-admin">Modifier</button>
        <a href="index.php?controller=Admin&action=orderOptions">Retour</a>
    </div>

</form>
