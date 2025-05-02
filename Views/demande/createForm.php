<section id="vehicule-details-reserve" style="background-image: url('<?= $vehicule->photo ? htmlspecialchars($vehicule->photo) : '' ?>');">
    <div class="form-reservation-container">
        <h1>Formulaire de demande de réservation</h1>
        <div class="infos-demande-reserve">
        <h2>Merci de vérifier les informations dans le formulaire avant de le soumettre</h2>
        <p>En cas de formulaire incorrect vous pouvez nous contacter via notre formulaire de contact ou au 02.43.28.33.14</p>
        <small>* Champs obligatoires</small> <br>
        <?php if (isset($_SESSION['message'])) :?>
        <small style="color: red;"><?= $_SESSION['message']?></small>
        <?php unset($_SESSION['message']); ?>
        <?php else : ?>
            <p></p>
            <?php endif; ?>
        </div>
        <form action="index.php?controller=Demande_reservation&action=create" method="post" id="form-demande-reservation" onsubmit="return confirm('Vos informations sont elles bien valide ?')">
            <input type="hidden" name="id_vehicule" value="<?= htmlspecialchars($vehicule->id_vehicule) ?>">
            <input type="hidden" id="prix_km" value="<?= floatval($vehicule->prix_km) ?>">
            <input type="hidden" id="prix_jour" value="<?= floatval($vehicule->prix_jour) ?>">
            <input type="hidden" id="prix_semaine" value="<?= floatval($vehicule->prix_semaine) ?>">
            <input type="hidden" id="prix_mois" value="<?= floatval($vehicule->prix_mois) ?>">

            <div class="form-reservation-columns">
                <!-- Bloc 1 : Infos utilisateur et véhicule -->
                <h1 class="title-demande">Vos informations</h1>
                <div class="form-reservation-left">
                    <div class="form-reservation-demande">
                        <label for="nom">Nom :</label>
                        <input type="text" id="nom" value="<?= htmlspecialchars($utilisateur->nom) ?>" disabled>
                    </div>
                    <div class="form-reservation-demande">
                        <label for="prenom">Prénom :</label>
                        <input type="text" id="prenom" value="<?= htmlspecialchars($utilisateur->prenom) ?>" disabled>
                    </div>
                    <div class="form-reservation-demande">
                        <label for="email">Email :</label>
                        <input type="email" id="email" value="<?= htmlspecialchars($utilisateur->email) ?>" disabled>
                    </div>
                    <div class="form-reservation-demande">
                        <label for="telephone">Téléphone :</label>
                        <input type="tel" id="telephone" value="<?= htmlspecialchars($utilisateur->numero_telephone) ?>" disabled>
                    </div>
                    <div class="form-reservation-demande">
                        <label for="ville">Ville :</label>
                        <input type="text" id="ville" value="<?= htmlspecialchars($utilisateur->ville) ?>" disabled>
                    </div>
                    <div class="form-reservation-demande">
                        <label for="nom_vehicule">Véhicule :</label>
                        <input type="text" id="nom_vehicule" value="<?= htmlspecialchars($vehicule->nom) ?>" disabled>
                    </div>
                    <div class="form-reservation-demande">
                        <label for="marque">Marque :</label>
                        <input type="text" id="marque" value="<?= htmlspecialchars($vehicule->marque) ?>" disabled>
                    </div>
                    <div class="form-reservation-demande">
                        <label for="modele">Modèle :</label>
                        <input type="text" id="modele" value="<?= htmlspecialchars($vehicule->modele) ?>" disabled>
                    </div>
                    <div class="form-reservation-demande">
                        <label for="annee">Année :</label>
                        <input type="text" id="annee" value="<?= htmlspecialchars($vehicule->annee) ?>" disabled>
                    </div>
                    <div class="form-reservation-demande">
                        <label for="categorie">Catégorie :</label>
                        <input type="text" id="categorie" value="<?= htmlspecialchars($vehicule->categorie) ?>" disabled>
                    </div>
                </div>

                <h1 class="title-demande">Détails</h1>
                <div class="form-reservation-right">
                    <div class="form-reservation-demande">
                        <label for="date_debut">*Date de début :</label>
                        <input type="date" name="date_debut" id="date_debut" required>
                    </div>

                    <div class="form-reservation-demande">
                        <label for="date_fin">*Date de fin :</label>
                        <input type="date" name="date_fin" id="date_fin" required>
                    </div>

                    <div class="form-reservation-demande">
                        <label for="forfait">*Type de forfait :</label>
                        <select name="forfait" id="forfait" required>
                            <option value="">-- Choisir un type --</option>
                            <option value="KM">Kilomètre</option>
                            <option value="Jour">Jour</option>
                            <option value="Semaine">Semaine</option>
                            <option value="Mois">Mois</option>
                        </select>
                    </div>

                    <div class="form-reservation-demande">
                        <label for="quantite_forfait">*Quantité :</label>
                        <input type="number" name="quantite_forfait" id="quantite_forfait" min="1" max="7" required>
                    </div>

                    <div class="form-reservation-demande">
                        <label for="montant_affiche">Montant estimé (€) :</label>
                        <input type="text" id="montant_affiche" readonly>
                    </div>

                    <div class="form-reservation-demande">
                        <label for="message">Message :</label>
                        <textarea name="message" id="message"></textarea>
                    </div>
                </div>
            </div>
            <div class="form-reservation-demande">
            <button type="submit">Envoyer la demande</button>
            </div>
        </form>
    </div>
</section>
<?php $scripts = ["calculPrixDr"]; ?>