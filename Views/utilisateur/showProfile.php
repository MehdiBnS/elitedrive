<section id="profile-show">
    <div class="profile-container">
        <!-- Informations personnelles -->
        <div class="profile-info">
            <h1>
                <?php
                if (isset($_SESSION['nom'], $_SESSION['prenom'])) {
                    echo htmlspecialchars($_SESSION['nom'] . ' ' . $_SESSION['prenom']);
                } elseif (isset($utilisateur->nom, $utilisateur->prenom)) {
                    echo htmlspecialchars($utilisateur->nom . ' ' . $utilisateur->prenom);
                } else {
                    echo 'Utilisateur inconnu';
                }
                ?>
            </h1>
            <div class="profile-details">
                <h2>Informations personnelles</h2>
                <p>Nom : <?= htmlspecialchars($utilisateur->nom) ?></p>
                <p>Prénom : <?= htmlspecialchars($utilisateur->prenom) ?></p>
                <p>Email : <?= htmlspecialchars($utilisateur->email) ?></p>
                <p>Téléphone : <?= htmlspecialchars($utilisateur->numero_telephone) ?></p>
                <p>Ville : <?= htmlspecialchars($utilisateur->ville) ?></p>
            </div>

            <!-- Actions -->
            <div class="profile-actions">
                <div id="action-profile-left">
                    <a href="index.php?controller=Utilisateur&action=updateForm&id_utilisateur=<?= $utilisateur->id_utilisateur ?>" class="btn">Modifier le profil</a>
                    <a href="index.php?action=editPassword" class="btn ">Modifier le mot de passe</a>
                </div>
                <div id="action-profile-right">
                    <a href="index.php?controller=Utilisateur&action=deletePage&id_utilisateur=<?= $utilisateur->id_utilisateur ?>" class="btn btn-danger">Supprimer le compte</a>
                    <a href="index.php?controller=Utilisateur&action=disconnect" class="btn btn-danger">Déconnexion</a>
                </div>
            </div>
        </div>

        <!-- Accordéons -->
        <div class="accordions-container">
            <!-- Demandes de réservation -->
            <div class="accordion-item">
                <button class="accordion-header">Mes demandes de réservation <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-caret-down-fill" viewBox="0 0 16 16">
                        <path d="M7.247 11.14 2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z" />
                    </svg></button>
                <div class="accordion-content">
                    <?php if (!empty($demande)) : ?>
                        <ul>
                            <?php foreach ($demande as $d) : ?>
                                <li>
                                    <a href="index.php?controller=Vehicule&action=showCarOne&id_vehicule=<?= $d->id_vehicule ?>"><?= htmlspecialchars($d->nom) ?></a><br>

                                    <img src="<?= htmlspecialchars($d->photo) ?>" alt="Photo de <?= htmlspecialchars($d->nom) ?>" width="150"><br>
                                    Du <?= htmlspecialchars($d->date_debut) ?> au <?= htmlspecialchars($d->date_fin) ?><br>
                                    Créer le : <?= htmlspecialchars($d->date_creation) ?><br>
                                    <span style="<?php
                                                    if ($d->statut == 'Acceptée') {
                                                        echo 'color: green; font-weight: bold;';
                                                    } elseif ($d->statut == 'Refusée') {
                                                        echo 'color: red; font-weight: bold;';
                                                    } else {
                                                        echo 'color: #555; font-style: italic;';
                                                    }
                                                    ?>">
                                        <?= htmlspecialchars($d->statut) ?>
                                    </span><br>

                                    Montant : <?= htmlspecialchars($d->montant) ?> €<br>

                                </li>
                            <?php endforeach; ?>
                        </ul>
                    <?php else : ?>
                        <p>Aucune demande de réservation trouvée.</p>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Réservations -->
            <div class="accordion-item">
                <button class="accordion-header">Mes réservations <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-caret-down-fill" viewBox="0 0 16 16">
                        <path d="M7.247 11.14 2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z" />
                    </svg></button>
                <div class="accordion-content">
                    <?php if (!empty($reservation)) : ?>
                        <ul>
                            <?php foreach ($reservation as $r) : ?>
                                <li>
                                    <a href="index.php?controller=Vehicule&action=showCarOne&id_vehicule=<?= $r->id_vehicule ?>"><?= htmlspecialchars($r->nom) ?></a><br>
                                    <?php if ($r->photo != null) : ?>
                                        <img src="<?= htmlspecialchars($r->photo) ?>" alt="Photo de <?= htmlspecialchars($r->nom) ?>" width="150">
                                    <?php else : ?>
                                        <?= htmlspecialchars('Aucun photo') ?><br>
                                    <?php endif; ?><br>

                                    Du <?= htmlspecialchars($r->date_debut) ?> au <?= htmlspecialchars($r->date_fin) ?>

                                </li>
                            <?php endforeach; ?>
                        </ul>
                    <?php else : ?>
                        <p>Aucune réservation trouvée.</p>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Avis -->
            <div class="accordion-item">
                <button class="accordion-header">Mes avis <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-caret-down-fill" viewBox="0 0 16 16">
                        <path d="M7.247 11.14 2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z" />
                    </svg></button>
                <div class="accordion-content">
                    <?php if (!empty($avis)) : ?>
                        <ul>
                            <?php foreach ($avis as $a) : ?>
                                <li>
                                    <div class="stars">
                                        <?php
                                        for ($i = 1; $i <= 5; $i++) {
                                            $color = $i <= $a->note ? 'darkgoldenrod' : 'grey';
                                            echo "<svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='$color' class='bi bi-star-fill' viewBox='0 0 16 16'>
                                        <path d='M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z'/>
                                    </svg>";
                                        }
                                        ?><small>(<?= htmlspecialchars($a->note) ?>/5)</small>
                                    </div><br>
                                    <?php if ($a->commentaire != null) : ?>
                                        <?= htmlspecialchars($a->commentaire) ?>
                                    <?php else : ?>
                                        <?= htmlspecialchars('Aucun commentaire posté') ?><br>
                                    <?php endif; ?>
                                    <?php if (isset($a->nom)) : ?>
                                        <a href="index.php?controller=Vehicule&action=showCarOne&id_vehicule=<?= $a->id_vehicule ?>"><?= htmlspecialchars($a->nom) ?></a><br>
                                        <?php if ($a->photo != null) : ?>
                                            <img src="<?= htmlspecialchars($a->photo) ?>" alt="Photo de <?= htmlspecialchars($a->nom) ?>" width="150">
                                        <?php else : ?>
                                            <?= htmlspecialchars('Aucun photo') ?><br>
                                        <?php endif; ?><br>
                                    <?php endif; ?>
                                    Posté le : <?= htmlspecialchars($a->date_creation) ?><br>
                                        <?php if ($_SESSION['id_utilisateur'] == $a->id_utilisateur): ?>
                                            <a href="#" class="modifier">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box-arrow-up" viewBox="0 0 16 16">
                                                    <path fill-rule="evenodd" d="M3.5 6a.5.5 0 0 0-.5.5v8a.5.5 0 0 0 .5.5h9a.5.5 0 0 0 .5-.5v-8a.5.5 0 0 0-.5-.5h-2a.5.5 0 0 1 0-1h2A1.5 1.5 0 0 1 14 6.5v8a1.5 1.5 0 0 1-1.5 1.5h-9A1.5 1.5 0 0 1 2 14.5v-8A1.5 1.5 0 0 1 3.5 5h2a.5.5 0 0 1 0 1z" />
                                                    <path fill-rule="evenodd" d="M7.646.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1-.708.708L8.5 1.707V10.5a.5.5 0 0 1-1 0V1.707L5.354 3.854a.5.5 0 1 1-.708-.708z" />
                                                </svg>
                                            </a>
                                        <?php endif; ?>
                                        <a href="#" class="supprimer" data-id-avis="<?= $a->id_avis ?>" data-id-utilisateur="<?= $a->id_utilisateur ?>">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
                                                <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5M8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5m3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0" />
                                            </svg>
                                        </a>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    <?php else : ?>
                        <p>Aucun avis trouvé.</p>
                    <?php endif; ?>
                </div>

            </div>
        </div>
    </div>
</section>