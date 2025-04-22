<h1>Users</h1>

<?php if ($utilisateurs): ?>
    <div class="order-admin">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Email</th>
                    <th>Rôle</th>
                    <th>Supprimer</th>
                    <th>Modifier</th>
                    <th>Afficher</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($utilisateurs as $utilisateur): ?>
                    <tr>
                        <td><?= htmlspecialchars($utilisateur->id_utilisateur) ?></td>
                        <td><?= htmlspecialchars($utilisateur->nom) ?></td>
                        <td><?= htmlspecialchars($utilisateur->prenom) ?></td>
                        <td><?= htmlspecialchars($utilisateur->email) ?></td>
                        <td><?= htmlspecialchars($utilisateur->role) ?></td>
                        <td><a href="index.php?controller=Admin&action=deleteUser&id_utilisateur=<?= htmlspecialchars($utilisateur->id_utilisateur) ?>">Supprimer</a></td>
                        <td><a href="index.php?controller=Admin&action=updateUserForm&id_utilisateur=<?= htmlspecialchars($utilisateur->id_utilisateur) ?>">Modifier</a></td>
                        <td><a href="index.php?controller=Admin&action=orderUserOne&id_utilisateur=<?= htmlspecialchars($utilisateur->id_utilisateur) ?>">Afficher</a></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
<?php else: ?>
    <div class="order-admin">
        Aucun utilisateur trouvé.
    </div>
<?php endif; ?>


    <button class="openModalBtn">Ajouter un utilisateur</button>



<!-- Modale -->
<div class="modal modalsAdmin">
    <div class="modal-content">

        <span class="close">&times;</span>
        <h2>Créer un utilisateur</h2>
        <form method="POST" action="index.php?controller=Admin&action=createUser" enctype="multipart/form-data" class="form-cars-create" id="register-form">

            <label for="nom">Nom :</label>
            <input type="text" id="nom" name="nom" required>

            <label for="prenom">Prénom :</label>
            <input type="text" id="prenom" name="prenom" required>

            <label for="email">Adresse email :</label>
            <input type="email" id="email" name="email" required>
            <span class="error-message-sub" id="email-error">Email invalide</span>

            <label for="password">Mot de passe :</label>
            <input type="password" id="password" name="password" required>

            <div id="password-requirements">
                <span class="error-message-sub" id="length">✔ Au moins 6 caractères</span><br>
                <span class="error-message-sub" id="uppercase">✔ Une majuscule</span><br>
                <span class="error-message-sub" id="lowercase">✔ Une minuscule</span><br>
                <span class="error-message-sub" id="digit">✔ Un chiffre</span><br>
                <span class="error-message-sub" id="symbol">✔ Un symbole (@$!%*?&)</span>
            </div>

            <label for="tel">Numéro de téléphone :</label>
            <input type="tel" id="tel" name="tel" required>
            <span class="error-message-sub" id="phone-error">Numéro de téléphone invalide</span>

            <label for="ville">Ville :</label>
            <input type="text" id="ville" name="ville" required>

            <label for="role">Rôle :</label>
            <select id="role" name="role" required>
                <option value="0">Utilisateur</option>
                <option value="1">Administrateur</option>
            </select>

            <button type="submit">Créer</button>
        </form>
    </div>
</div>
<div class="order-admin">
<a href="index.php?controller=Admin&action=backOffice">Retour</a>
</div>