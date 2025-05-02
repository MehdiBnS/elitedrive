<div class="background-wrapper">
    <div class="background-image" style="background-image: url('../public/img/user/backgroundCars.jpg');"></div>
    <div class="container-admin-one">
        <?php

        if ($utilisateur) {
            $role = $utilisateur->role == 1 ? 'Administrateur' : 'Utilisateur';
        ?>
            <h1><?php echo htmlspecialchars($role); ?>: <?php echo htmlspecialchars($utilisateur->nom . ' ' . $utilisateur->prenom); ?></h1>
            <div class="order-admin-one">
                <ul>
                    <li><strong>Email :</strong> <?php echo htmlspecialchars($utilisateur->email); ?></li>
                    <li><strong>Numéro de téléphone :</strong> <?php echo htmlspecialchars($utilisateur->numero_telephone); ?></li>
                    <li><strong>Ville :</strong> <?php echo htmlspecialchars($utilisateur->ville); ?></li>
                    <li><strong>Date de création :</strong> <?php echo htmlspecialchars($utilisateur->date_creation); ?></li>
                </ul>

                <div class="order-admin-one-button">
                    <button class="btn-edit-user" data-utilisateur='<?= json_encode($utilisateur) ?>'>
                        Modifier
                    </button>
                    <a href="index.php?controller=Admin&action=deleteUser&id_utilisateur=<?php echo htmlspecialchars($utilisateur->id_utilisateur); ?>">Supprimer</a>
                    <a href="index.php?controller=Admin&action=orderUsers">Retour</a>
                </div>
            </div>
        <?php
        } else {
        ?>
            <h1>Aucun utilisateur trouvé</h1>
        <?php
        }
        ?>
    </div>
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
<?php $scripts = ["formSub", "admin/updateUser"]; ?>