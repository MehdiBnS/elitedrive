<h2>Modifier une catégorie</h2>

<form method="POST" action="index.php?controller=Admin&action=updateCategory&" enctype="multipart/form-data" class="form-update-admin">

    <div class="form-group-admin">
        <label for="id_categorie" class="form-label-admin">ID catégorie :</label>
        <input type="hidden" id="id_categorie" name="id_categorie" class="form-input-admin" value="<?= $categorie->id_categorie ?>">
    </div>

    <div class="form-group-admin">
        <label for="nom" class="form-label-admin">Nom de la catégorie :</label>
        <input type="text" id="nom" name="nom" class="form-input-admin" value="<?= htmlspecialchars($categorie->nom) ?>" required>
    </div>

    <div class="form-group-admin">
        <label for="description" class="form-label-admin">Description :</label>
        <textarea id="description" name="description" class="form-input-admin" required><?= htmlspecialchars($categorie->description) ?></textarea>
    </div>

    <div class="form-group-admin">
        <label for="photo" class="form-label-admin">Photo de la catégorie :</label>
        <input type="file" id="photo" name="photo" class="form-input-admin" accept="image/*">
        <?php if ($categorie->photo != null) : ?>
            <img src="<?= $categorie->photo ?>" alt="Photo de la Catégorie">
            <p>Photo Actuelle</p>
            <?php else :?>
                <p>Pas de photo de la catégoorie</p>
                <?php endif;?>
    </div>

    <div class="form-group-admin">
        <button type="submit" class="form-button-admin">Modifier</button>
        <a href="index.php?controller=Admin&action=orderOptions">Retour</a>
    </div>

</form>