<div class="form-container-user">
    <form class="form-user" id="login-form" method="POST" action="index.php?controller=Utilisateur&action=connectUser">
        <h2>Connexion</h2>
        <div class="form-group-user">
            <label for="login-email">Email :</label>
            <input type="email" id="login-email" name="email" required>
        </div>

        <div class="form-group-user">
            <label for="password">Mot de passe :</label>
            <input type="password" id="login-password" name="password" required>
            <span id="togglePassword" style="top: 51%;">
                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="black" class="bi bi-eye" viewBox="0 0 16 16">
                    <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8M1.173 8a13 13 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5s3.879 1.168 5.168 2.457A13 13 0 0 1 14.828 8q-.086.13-.195.288c-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5s-3.879-1.168-5.168-2.457A13 13 0 0 1 1.172 8z" />
                    <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5M4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0" />
                </svg>
            </span>
        </div>

        <div class="form-group-user full-width">
            <button type="submit">Se connecter</button>
            <p style="color: red;"><?php if (isset($_SESSION['message'])) {
                                        echo $_SESSION['message'];
                                        unset($_SESSION['message']);
                                    } else {
                                        echo '';
                                    } ?></p>

        </div>
        <div class="form-group-user full-width">
            <a href="index.php?controller=Utilisateur&action=subForm">Je n'ai pas de compte chez EliteDrive</a>
        </div>
    </form>


</div>

<?php $scripts = ["showPassword"]; ?>