<?php if ($utilisateurs): ?>
    <div class="order-admin">
        <h1 style="color: black;">Utilisateurs</h1>
        <div class="navbar-admin">
            <div class="order-admin-button">
                <a href="index.php?controller=Admin&action=backOffice">Retour</a>
            </div>
            <form method="post" action="index.php?controller=Admin&action=orderUsers" class="filter-form">
                <input type="text" name="search" placeholder="Rechercher un utilisateur" value="<?= htmlspecialchars($search ?? '') ?>">
                <button type="submit" class="filter-button">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                        <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0" />
                    </svg>
                </button>
                <a href="index.php?controller=Admin&action=orderUsers" style="margin-left: 10px;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-arrow-counterclockwise" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M8 3a5 5 0 1 1-4.546 2.914.5.5 0 0 0-.908-.417A6 6 0 1 0 8 2z" />
                        <path d="M8 4.466V.534a.25.25 0 0 0-.41-.192L5.23 2.308a.25.25 0 0 0 0 .384l2.36 1.966A.25.25 0 0 0 8 4.466" />
                    </svg>
                </a>
            </form>

            <button class="openModalBtn">Ajouter un utilisateur</button>



            <!-- Modale -->
            <div class="modal modalsAdmin">
                <div class="modal-content">

                    <span class="close">&times;</span>
                    <h2>Créer un utilisateur</h2>
                    <form id="createUserForm" method="POST" action="index.php?controller=Admin&action=createUser" enctype="multipart/form-data" class="form-cars-create" id="register-form">

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
                        <p id="statusMessage" style="text-align: center; color: darkgoldenrod"></p>
                    </form>
                </div>
            </div>
        </div>
        <table id="userTable">
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
                        <td><button class="btn-edit-user" data-utilisateur='<?= json_encode($utilisateur) ?>'>
                                Modifier
                            </button>
                        </td>
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
<div class="modal modalUpdateUser">
    <div class="modal-update modalUpdateUser-content">
        <span class="close closeUpdateUser">&times;</span>
        <h2>Modifier un utilisateur</h2>

        <form method="POST" action="index.php?controller=Admin&action=updateUser" class="form-update-admin">
            <input type="hidden" id="id_utilisateur" name="id_utilisateur" readonly>

            <div class="form-group-admin">
                <label for="nom">Nom :</label>
                <input type="text" id="nom" name="nom" class="form-input-admin" required>
            </div>

            <div class="form-group-admin">
                <label for="prenom">Prénom :</label>
                <input type="text" id="prenom" name="prenom" class="form-input-admin" required>
            </div>

            <div class="form-group-admin">
                <label for="email">Email :</label>
                <input type="email" id="email" name="email" class="form-input-admin" required>
            </div>

            <div class="form-group-admin">
                <label for="numero_telephone">Téléphone :</label>
                <input type="tel" id="numero_telephone" name="numero_telephone" class="form-input-admin" required>
            </div>

            <div class="form-group-admin">
                <label for="ville">Ville :</label>
                <input type="text" id="ville" name="ville" class="form-input-admin" required>
            </div>

            <div class="form-group-admin">
                <label for="role">Rôle :</label>
                <select id="role" name="role" class="form-input-admin">
                    <option value="0">Utilisateur</option>
                    <option value="1">Admin</option>
                </select>
            </div>

            <div class="form-group-admin">
                <button type="submit">Modifier</button>
            </div>
        </form>
    </div>
</div>

</div>

<?php $scripts = ["admin/searchUser", "admin/addUser", "modals", "formSub", "admin/updateUser"]; ?>