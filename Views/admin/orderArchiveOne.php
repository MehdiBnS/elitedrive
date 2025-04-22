<div class="background-wrapper">
    <div class="background-image" style="background-image: url('../public/img/user/backgroundCars.jpg');"></div>
    <div class="container-admin-one">
        <h1>Archive: <?php echo htmlspecialchars($archive->id_archive); ?> - <?php echo htmlspecialchars($archive->nom); ?> <?php echo htmlspecialchars($archive->prenom); ?></h1>

        <?php
        if ($archive) {
        ?>
            <div class="order-admin-one">
                <ul>
                    <li><strong>Nom:</strong> <?php echo htmlspecialchars($archive->nom); ?></li>
                    <li><strong>Prénom:</strong> <?php echo htmlspecialchars($archive->prenom); ?></li>
                    <li><strong>Téléphone:</strong> <?php echo htmlspecialchars($archive->numero_telephone); ?></li>
                    <li><strong>Ville:</strong> <?php echo htmlspecialchars($archive->ville); ?></li>
                    <li><strong>Email:</strong> <?php echo htmlspecialchars($archive->email); ?></li>
                    <li><strong>Véhicule:</strong> <?php echo htmlspecialchars($archive->nom_vehicule); ?></li>
                    <li><strong>Modèle:</strong> <?php echo htmlspecialchars($archive->modele); ?></li>
                    <li><strong>Marque:</strong> <?php echo htmlspecialchars($archive->marque); ?></li>
                    <li><strong>Catégorie:</strong> <?php echo htmlspecialchars($archive->categorie_vehicule); ?></li>
                    <li><strong>Montant (€):</strong> <?php echo htmlspecialchars(number_format($archive->montant, 2)); ?></li>
                    <li><strong>Date:</strong> <?php echo htmlspecialchars($archive->date); ?></li>
                </ul>
            </div>
        <?php
        } else {
            echo '<div class="order-admin">Aucune archive trouvée.</div>';
        }
        ?>
        <div class="order-admin-one-button">
            <div class="order-admin-one">
                <a href="index.php?controller=Admin&action=orderArchives">Retour</a>
            </div>
        </div>
    </div>
</div>