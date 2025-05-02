        <div class="form-container-user">
            <form class="form-user" id="register-form" method="POST" action="index.php?controller=Utilisateur&action=createUserUt">
                <h2>Inscription</h2>
                <?php
                if (isset($_SESSION['message'])) : ?>
                    <p style="color: red;"> <?= htmlspecialchars($_SESSION['message']) ?> </p>
                    <?php
                    unset($_SESSION['message']); ?>
                <?php else : ?>
                    <p></p>

                <?php endif; ?>


                <div class="form-group-user">
                    <label for="name">Nom :</label>
                    <input type="text" id="name" name="name" placeholder="Marc" required>
                </div>

                <div class="form-group-user">
                    <label for="surname">Prénom :</label>
                    <input type="text" id="surname" name="surname" placeholder="Zulian" required>
                </div>

                <div class="form-group-user full-width">
                    <label for="email">Email :</label>
                    <input type="email" id="email" name="email" placeholder="marczulian@elite.com" required>
                    <span class="error-message-sub" id="email-error">Email invalide</span>
                </div>

                <div class="form-group-user full-width">
                    <label for="password">Mot de passe :</label>
                    <input type="password" id="password" name="password" required>
                    <div id="password-requirements">
                        <span class="error-message-sub" id="length">✔ Au moins 6 caractères</span><br>
                        <span class="error-message-sub" id="uppercase">✔ Une majuscule</span><br>
                        <span class="error-message-sub" id="lowercase">✔ Une minuscule</span><br>
                        <span class="error-message-sub" id="digit">✔ Un chiffre</span><br>
                        <span class="error-message-sub" id="symbol">✔ Un symbole (@$!%*?&)</span>
                    </div>
                </div>

                <div class="form-group-user">
                    <label for="tel">Numéro de téléphone :</label>
                    <input type="tel" id="tel" name="tel" placeholder="0772345678" required>
                    <span class="error-message-sub" id="phone-error">Numéro de téléphone invalide</span>
                </div>

                <div class="form-group-user">
                    <label for="city">Ville :</label>
                    <input type="text" id="city" name="city" placeholder="Monaco" required>
                </div>

                <div class="form-group-user full-width">
                    <button type="submit">S'inscrire</button>
                </div>

                <div class="form-group-user full-width">
                    <a href="index.php?controller=Utilisateur&action=connectForm">Je possède un compte chez EliteDrive</a>
                </div>
            </form>
        </div>

        <?php $scripts = ["formSub"]; ?>