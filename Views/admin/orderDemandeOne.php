<div class="background-wrapper">
    <div class="background-image" style="background-image: url('../public/img/user/backgroundCars.jpg');"></div>
    <div class="container-admin-one">
        <h1>Demande de réservation:
            <?php echo htmlspecialchars($demande->id_demande_reservation); ?> -
            <?php echo htmlspecialchars($demande->nom); ?>
            <?php echo htmlspecialchars($demande->prenom); ?>
        </h1>

        <?php if ($demande): ?>
            <div class="order-admin-one">
                <ul>
                    <li><strong>Nom:</strong> <?php echo htmlspecialchars($demande->nom ?? 'Nom non défini'); ?></li>
                    <li><strong>Prénom:</strong> <?php echo htmlspecialchars($demande->prenom ?? 'Prénom non défini'); ?></li>
                    <li><strong>Téléphone:</strong> <?php echo htmlspecialchars($demande->numero_telephone ?? 'Téléphone non défini'); ?></li>
                    <li><strong>Ville:</strong> <?php echo htmlspecialchars($demande->ville ?? 'Ville non renseignée'); ?></li>
                    <li><strong>Email:</strong> <?php echo htmlspecialchars($demande->email ?? 'Email non défini'); ?></li>
                    <li><strong>Montant:</strong> <?php echo htmlspecialchars($demande->montant ?? 'Non précisé'); ?></li>
                    <li><strong>Forfait:</strong> <?php echo htmlspecialchars($demande->forfait ?? 'Forfait non défini'); ?></li>
                    <li><strong>Date de début:</strong> <?php echo htmlspecialchars($demande->date_debut ?? 'Non précisée'); ?></li>
                    <li><strong>Date de fin:</strong> <?php echo htmlspecialchars($demande->date_fin ?? 'Non précisée'); ?></li>
                    <li><strong>Date de création:</strong> <?php echo htmlspecialchars($demande->date_creation ?? 'Non disponible'); ?></li>
                    <li><strong>Statut:</strong> <?php echo htmlspecialchars($demande->statut ?? 'Statut non défini'); ?></li>
                    <li><strong>Message:</strong> <?php echo (!empty($demande->message) ? htmlspecialchars($demande->message) : 'Aucun message'); ?></li>
                    <li><strong>Véhicule:</strong> <?php echo htmlspecialchars($demande->nom_vehicule ?? 'Véhicule non spécifié'); ?></li>
                    <li><strong>Statut du véhicule:</strong> <?php echo htmlspecialchars($demande->statut_vehicule ?? 'Statut non défini'); ?></li>

                    <?php if (!empty($demande->photo)): ?>
                        <li><strong></strong> <img src="<?php echo htmlspecialchars($demande->photo); ?>" alt="Photo du véhicule" /></li>
                    <?php else: ?>
                        <li><strong></strong> Aucune photo disponible</li>
                    <?php endif; ?>
                </ul>
            </div>

        <?php else: ?>
            <div class="order-admin-one">
                <p>Aucune demande de réservation trouvée.</p>
            </div>
        <?php endif; ?>

        <div class="order-admin-one">

        </div>

        <form action="index.php?controller=Admin&action=updateStatutDemande" method="POST">
            <div class="order-admin-one">
                <input type="hidden" name="id_demande" value="<?php echo htmlspecialchars($demande->id_demande_reservation); ?>">
                <input type="hidden" name="id_utilisateur" value="<?php echo htmlspecialchars($demande->id_utilisateur); ?>">
                <input type="hidden" name="email" value="<?php echo htmlspecialchars($demande->email); ?>">
                <input type="hidden" name="nom" value="<?php echo htmlspecialchars($demande->nom); ?>">
                <input type="hidden" name="prenom" value="<?php echo htmlspecialchars($demande->prenom); ?>">
                <input type="hidden" name="id_vehicule" value="<?php echo htmlspecialchars($demande->id_vehicule); ?>">
                <input type="hidden" name="montant" value="<?php echo htmlspecialchars($demande->montant); ?>">
                <input type="hidden" name="forfait" value="<?php echo htmlspecialchars($demande->forfait); ?>">
                <input type="hidden" name="date_debut" value="<?php echo htmlspecialchars($demande->date_debut); ?>">
                <input type="hidden" name="date_fin" value="<?php echo htmlspecialchars($demande->date_fin); ?>">
                <div class="order-admin-one-button">
                    <a href="index.php?controller=Admin&action=orderDemande">Retour</a>
                    <button type="submit" name="statut" value="Acceptée" onclick="return confirm('Voulez-vous vraiment accepter cette demande ?')">Accepter</button>
                    <button type="submit" name="statut" value="Refusée" onclick="return confirm('Voulez-vous vraiment refuser cette demande ?')">Refuser</button>
                </div>
            </div>
        </form>
    </div>
</div>