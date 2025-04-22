<div class="background-wrapper">
    <div class="background-image" style="background-image: url('<?= $avis->photo ?? ''?>');"></div>
<div class="container-admin-one">
<h1>
    <?php if ($avis): ?>
        Avis de <?= htmlspecialchars($avis->nom) ?> <?= htmlspecialchars($avis->prenom) ?> - <?= htmlspecialchars($avis->nom_vehicule) ?>
    <?php else: ?>
        Aucun avis trouvé
    <?php endif; ?>
</h1>

<?php if ($avis): ?>
    <div class="order-admin-one">
        <ul>
            <li><strong>Nom :</strong> <?= htmlspecialchars($avis->nom) ?></li>
            <li><strong>Prénom :</strong> <?= htmlspecialchars($avis->prenom) ?></li>
            <li><strong>Email :</strong> <?= htmlspecialchars($avis->email) ?></li>
            <li><strong>Véhicule :</strong> <?= htmlspecialchars($avis->nom_vehicule) ?></li>
            <li><strong>Note :</strong> <?= htmlspecialchars($avis->note) ?> / 5</li>
            <li><strong>Commentaire :</strong> <?= !empty($avis->commentaire) ? htmlspecialchars($avis->commentaire) : 'Aucun commentaire' ?></li>
            <li><strong>Date :</strong> <?= htmlspecialchars($avis->date_creation) ?></li>
        </ul>
    </div>

    <div class="order-admin-one-button">
    <div class="order-admin-one">
        <a href="index.php?controller=Admin&action=deleteAvis&id_avis=<?= htmlspecialchars($avis->id_avis) ?>">Supprimer</a>
    </div>

    <div class="order-admin-one">
        <a href="index.php?controller=Admin&action=orderAvis">Retour</a>
    </div>
    </div>
<?php endif; ?>
</div>
</div>