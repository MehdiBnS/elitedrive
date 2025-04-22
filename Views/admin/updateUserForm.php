        <h2>Modifier un utilisateur</h2>

        <form method="POST" action="index.php?controller=Admin&action=updateUser" class="form-update-admin">

            <div class="form-group-admin">
                <label for="id_utilisateur" class="form-label-admin"></label>
                <input type="hidden" id="id_utilisateur" name="id_utilisateur" class="form-input-admin" value="<?= $utilisateur->id_utilisateur ?>" readonly>
            </div>

            <div class="form-group-admin">
                <label for="nom" class="form-label-admin">Nom :</label>
                <input type="text" id="nom" name="nom" class="form-input-admin" value="<?= htmlspecialchars($utilisateur->nom) ?>" required>
            </div>

            <div class="form-group-admin">
                <label for="prenom" class="form-label-admin">Prénom :</label>
                <input type="text" id="prenom" name="prenom" class="form-input-admin" value="<?= htmlspecialchars($utilisateur->prenom) ?>" required>
            </div>

            <div class="form-group-admin">
                <label for="email" class="form-label-admin">Email :</label>
                <input type="email" id="email" name="email" class="form-input-admin" value="<?= htmlspecialchars($utilisateur->email) ?>" required>
            </div>

            <div class="form-group-admin">
                <label for="numero_telephone" class="form-label-admin">Téléphone :</label>
                <input type="tel" id="numero_telephone" name="numero_telephone" class="form-input-admin" value="<?= htmlspecialchars($utilisateur->numero_telephone) ?>" required>
            </div>

            <div class="form-group-admin">
                <label for="ville" class="form-label-admin">Ville :</label>
                <input type="text" id="ville" name="ville" class="form-input-admin" value="<?= htmlspecialchars($utilisateur->ville) ?>" required>
            </div>

            <div class="form-group-admin">
                <label for="role" class="form-label-admin">Rôle :</label>
                <select id="role" name="role" class="form-input-admin">
                    <option value="0" <?= $utilisateur->role == 0 ? 'selected' : '' ?>>Utilisateur</option>
                    <option value="1" <?= $utilisateur->role == 1 ? 'selected' : '' ?>>Admin</option>
                </select>
            </div>

            <div class="form-group-admin">
                <button type="submit" class="form-button-admin">Modifier</button>
                <a href="index.php?controller=Admin&action=orderUsers">Retour</a>
            </div>

        </form>
    </div>
</div>