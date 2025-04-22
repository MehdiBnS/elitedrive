<h2>Modifier le nombre de places</h2>

<form method="POST" action="index.php?controller=Admin&action=updatePlaces" class="form-update-admin">

    <div class="form-group-admin">
        <label for="id_places" class="form-label-admin">ID places :</label>
        <input type="hidden" id="id_places" name="id_places" class="form-input-admin" value="<?= $places->id_places ?>">
    </div>

    <div class="form-group-admin">
        <label for="nombre" class="form-label-admin">Nombre de places :</label>
        <input type="number" id="nombre" name="nombre" class="form-input-admin" value="<?= htmlspecialchars($places->nombre) ?>" required>
    </div>

    <div class="form-group-admin">
        <button type="submit" class="form-button-admin">Modifier</button>
        <a href="index.php?controller=Admin&action=orderOptions">Retour</a>
    </div>

</form>
