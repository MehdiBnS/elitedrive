<h2>Modifier la transmission</h2>

<form method="POST" action="index.php?controller=Admin&action=updateTransmission" class="form-update-admin">

    <div class="form-group-admin">
        <label for="id_transmission" class="form-label-admin">ID transmission :</label>
        <input type="hidden" id="id_transmission" name="id_transmission" class="form-input-admin" value="<?= $transmission->id_transmission ?>">
    </div>

    <div class="form-group-admin">
        <label for="type" class="form-label-admin">Type de transmission :</label>
        <input type="text" id="type" name="type" class="form-input-admin" value="<?= htmlspecialchars($transmission->type) ?>" required>
    </div>

    <div class="form-group-admin">
        <button type="submit" class="form-button-admin">Modifier</button>
        <a href="index.php?controller=Admin&action=orderOptions">Retour</a>
    </div>

</form>
