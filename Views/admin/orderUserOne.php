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
        <a href="index.php?controller=Admin&action=updateUserForm&id_utilisateur=<?php echo htmlspecialchars($utilisateur->id_utilisateur); ?>">Modifier</a>
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
<a href="index.php?controller=Admin&action=orderUser">Retour</a>
</div>
</div>