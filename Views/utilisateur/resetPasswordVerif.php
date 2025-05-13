<div class="form-container-user">
    <form class="form-user" id="reset-password-form" method="POST" action="index.php?controller=Utilisateur&action=resetPassword">
        <h2>Réinitialisation du mot de passe</h2>

        <?php
        if (isset($_SESSION['message'])) : ?>
            <p style="color: red;"> <?= htmlspecialchars($_SESSION['message']) ?> </p>
            <?php
            unset($_SESSION['message']); ?>
        <?php else : ?>
            <p></p>

        <?php endif; ?>

        <label for="id_utilisateur">
            <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($token) ?>">
            <input type="hidden" id="id_utilisateur" name="id_utilisateur" value="<?= $utilisateur->id_utilisateur ?>" required disabled>

            <!-- Ancien mot de passe -->
            <div class="form-group-user full-width">
                <label for="current-password">Mot de passe actuel :</label>
                <input type="password" id="current-password" name="current_password" required>
                <span class="error-message-sub" id="current-password-error">Mot de passe actuel incorrect</span>
            </div>

            <!-- Nouveau mot de passe -->
            <div class="form-group-user full-width">
                <label for="password">Nouveau mot de passe :</label>
                <input type="password" id="password" name="password" required>
                <div id="password-requirements">
                    <span class="error-message-sub">✔ Au moins 8 caractères</span><br>
                    <span class="error-message-sub">✔ Une majuscule</span><br>
                    <span class="error-message-sub">✔ Une minuscule</span><br>
                    <span class="error-message-sub">✔ Un chiffre</span><br>
                    <span class="error-message-sub">✔ Un symbole (@$!%*?&)</span>
                </div>
            </div>

            <div class="form-group-user full-width">
                <button type="submit">Valider</button>
            </div>
    </form>
</div>
<?php $scripts = ["formSub"]; ?>