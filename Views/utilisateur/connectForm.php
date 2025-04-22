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