<div class="form-container-user">
    <form class="form-user" id="update-form" method="POST" action="index.php?controller=Utilisateur&action=update">
        <h2>Modifier le compte</h2>

        <?php
        if (isset($_SESSION['message'])) : ?>
            <p style="color: red;"> <?= htmlspecialchars($_SESSION['message']) ?> </p>
            <?php
            unset($_SESSION['message']); ?>
        <?php else : ?>
            <p></p>

        <?php endif; ?>

        <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($token) ?>">

        <input type="hidden" id="id_utilisateur" name="id_utilisateur" value="<?= $utilisateur->id_utilisateur ?>" required readonly>



        <div class="form-group-user">
            <label for="name">Nom :</label>
            <input type="text" id="name" name="name" value="<?= $utilisateur->nom ?>" required>
        </div>
        <div class="form-group-user">
            <label for="surname">Prénom :</label>
            <input type="text" id="surname" name="surname" value="<?= $utilisateur->prenom ?>" required>
        </div>
        <div class="form-group-user">
            <label for="tel">Numéro de téléphone :</label>
            <input type="tel" id="tel" name="tel" value="<?= $utilisateur->numero_telephone ?>" required>
            <span class="error-message-sub" id="phone-error">Numéro de téléphone invalide</span>

        </div>
        <div class="form-group-user">
            <label for="email">E-mail</label>
            <input type="email" id="email" name="email" value="<?= $utilisateur->email ?>" required>
            <span class="error-message-sub" id="email-error">Email invalide</span>

        </div>
        <div class="form-group-user">
            <label for="city">Ville :</label>
            <input type="text" id="city" name="city" value="<?= $utilisateur->ville ?>" required>
        </div>
        <div class="form-group-user full-width">
            <button type="submit">Modifier</button>
        </div>
    </form>

    <a href="index.php?controller=Utilisateur&action=showProfile">Annuler</a>
</div>
<?php $scripts = ["formSub"]; ?>