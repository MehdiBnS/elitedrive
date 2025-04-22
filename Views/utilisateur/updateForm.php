<form class="form-user" id="update-form" method="POST" action="index.php?controller=Utilisateur&action=update">
        <h2>Inscription</h2>
        
        <label for="id_utilisateur">
        <input type="hidden" id="id_utilisateur" name="id_utilisateur" value="<?= $utilisateur->id_utilisateur ?>">
        </label>

        <label for="name">Nom :</label>
        <input type="text" id="name" name="name" value="<?= $utilisateur->nom ?>" required>
        
        <label for="surname">Prénom :</label>
        <input type="text" id="surname" name="surname" value="<?= $utilisateur->prenom ?>" required>

        <label for="tel">Numéro de téléphone :</label>
        <input type="tel" id="tel" name="tel" value="<?= $utilisateur->numero_telephone ?>" required>

        
        <label for="city">Ville :</label>
        <input type="text" id="city" name="city" value="<?= $utilisateur->ville ?>" required>
        <button type="submit">Modifier</button>
    </form>
    
    <a href="index.php?controller=Utilisateur&action=showProfile">Annuler</a>