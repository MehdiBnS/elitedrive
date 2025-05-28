<section id="vehicule-details" style="background-image: url('<?= $vehicule->photo ? htmlspecialchars($vehicule->photo) : '' ?>');">


    <div class="vehicule-one-container">
        <div class="vehicule-one-photo">
            <?php if ($vehicule->photo != null) : ?>
                <img src="<?= htmlspecialchars($vehicule->photo) ?>" alt="<?= htmlspecialchars($vehicule->nom) ?>">
            <?php else : ?>
                <h2>Aucune photo disponible</h2>
            <?php endif; ?>
        </div>

        <div class="vehicule-one-info">
            <h1 class="vehicule-one-title"><?= htmlspecialchars($vehicule->nom) ?></h1>
            <p><?= nl2br(htmlspecialchars($vehicule->description)) ?></p>
            <div class="vehicule-one-characteristics">
                <table>
                    <tr>
                        <td><strong>Marque :</strong></td>
                        <td><?= isset($vehicule->marque) ? htmlspecialchars($vehicule->marque) : 'Non renseignée' ?></td>
                    </tr>
                    <tr>
                        <td><strong>Modèle :</strong></td>
                        <td><?= isset($vehicule->modele) ? htmlspecialchars($vehicule->modele) : 'Non renseigné' ?></td>
                    </tr>
                    <tr>
                        <td><strong>Année :</strong></td>
                        <td><?= isset($vehicule->annee) ? htmlspecialchars($vehicule->annee) : 'Non renseignée' ?></td>
                    </tr>
                    <tr>
                        <td><strong>Catégorie :</strong></td>
                        <td><?= isset($vehicule->categorie) ? htmlspecialchars($vehicule->categorie) : 'Non renseignée' ?></td>
                    </tr>
                    <tr>
                        <td><strong>Carburant :</strong></td>
                        <td><?= isset($vehicule->carburant) ? htmlspecialchars($vehicule->carburant) : 'Non renseigné' ?></td>
                    </tr>
                    <tr>
                        <td><strong>Transmission :</strong></td>
                        <td><?= isset($vehicule->transmission) ? htmlspecialchars($vehicule->transmission) : 'Non renseignée' ?></td>
                    </tr>
                    <tr>
                        <td><strong>Nombre de places :</strong></td>
                        <td><?= isset($vehicule->places) ? htmlspecialchars($vehicule->places) : 'Non renseigné' ?></td>
                    </tr>
                    <tr>
                        <td><strong>Statut : </strong></td>
                        <td><?= isset($vehicule->statut) ? htmlspecialchars($vehicule->statut) : 'Non renseigné' ?></td>
                    </tr>
                </table>
            </div>

            <table class="vehicule-one-prices">
                <thead>
                    <tr>
                        <th>Prix/km</th>
                        <th>Prix/jour</th>
                        <th>Prix/semaine</th>
                        <th>Prix/mois</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><?= htmlspecialchars($vehicule->prix_km) ?> €</td>
                        <td><?= htmlspecialchars($vehicule->prix_jour) ?> €</td>
                        <td><?= htmlspecialchars($vehicule->prix_semaine) ?> €</td>
                        <td><?= htmlspecialchars($vehicule->prix_mois) ?> €</td>
                    </tr>
                </tbody>
            </table>
            <div id="vehicule-prices">
                <h2>Tarifs :</h2>
                <p>Prix KM : <span><?= htmlspecialchars($vehicule->prix_km) ?> €</span></p>
                <p>Prix Jour : <span><?= htmlspecialchars($vehicule->prix_jour) ?> €</span></p>
                <p>Prix Semaine : <span><?= htmlspecialchars($vehicule->prix_semaine) ?> €</span></p>
                <p>Prix Mois : <span><?= htmlspecialchars($vehicule->prix_mois) ?> €</span></p>

            </div>
        </div>
    </div>

    <div class="avis-section">
        <?php if (!empty($_SESSION['id_utilisateur']) && isset($_SESSION['role']) && $_SESSION['role'] == 0) : ?>
            <form action="index.php?controller=Avis&action=create&id_vehicule=<?= $vehicule->id_vehicule ?>" method="POST" id="avisForm">
                <h1>Vous souhaitez nous laisser un avis ?</h1>
                <label for="rate"></label>
                <div class="stars" id="stars">
                    <?php for ($i = 1; $i <= 5; $i++) : ?>
                        <span class="star" data-value="<?= $i ?>">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-star-fill" viewBox="0 0 16 16">
                                <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z" />
                            </svg>
                        </span>
                    <?php endfor; ?>
                </div>

                <input type="hidden" name="rate" id="rate" required>
                <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($token) ?>">

                <label for="comment">Commentaire :</label>
                <textarea name="comment" id="comment" rows="4" placeholder="Écrivez votre commentaire ici..."></textarea>

                <button type="submit">Envoyer</button>
            </form>
        <?php elseif (isset($_SESSION['role']) && $_SESSION['role'] == 1) : ?>
            <small>Conformément aux règles d’EliteDrive, les administrateurs ne sont pas autorisés à laisser des avis afin de garantir l’objectivité.</small>
        <?php else : ?>
            <small>Veuillez-vous connecter avec votre compte client pour déposer un avis</small>
        <?php endif; ?>
        <div id="messageContainer"></div>

        <h3>Avis des utilisateurs :</h3>
        <div id="avisContainer">
            <?php if (!empty($avis)) : ?>
                <ul>
                    <?php foreach ($avis as $a) : ?>
                        <li class="avis-item" data-id-avis="<?= $a->id_avis ?>" data-id-utilisateur="<?= $a->id_utilisateur ?>">
                            <strong><?= htmlspecialchars($a->nom_utilisateur) . ' ' . htmlspecialchars($a->prenom_utilisateur) ?></strong> :
                            <div class="stars">
                                <?php
                                for ($i = 1; $i <= 5; $i++) {
                                    $color = $i <= $a->note ? 'darkgoldenrod' : 'white';
                                    echo "<svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='$color' class='bi bi-star-fill' viewBox='0 0 16 16'>
                                <path d='M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z'/>
                            </svg>";
                                }
                                ?>
                            </div>
                            <span style="color: white;">Commentaire : <?= nl2br(htmlspecialchars(empty($a->commentaire) ? 'Avis sans message' : $a->commentaire)) ?></span>

                            <?php if (
                                isset($_SESSION['id_utilisateur']) &&
                                (
                                    $_SESSION['id_utilisateur'] == $a->id_utilisateur ||
                                    (isset($_SESSION['role']) && $_SESSION['role'] == 1)
                                )
                            ) : ?>
                                <div class="actions">
                                    <?php if ($_SESSION['id_utilisateur'] == $a->id_utilisateur): ?>
                                        <a href="" class="modifier"
                                            data-id-avis="<?= $a->id_avis ?>"
                                            data-id-utilisateur="<?= $a->id_utilisateur ?>"
                                            data-id-vehicule="<?= $vehicule->id_vehicule ?>"
                                            data-commentaire="<?= htmlspecialchars($a->commentaire) ?>">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                                class="bi bi-box-arrow-up" viewBox="0 0 16 16">
                                                <path fill-rule="evenodd"
                                                    d="M3.5 6a.5.5 0 0 0-.5.5v8a.5.5 0 0 0 .5.5h9a.5.5 0 0 0 .5-.5v-8a.5.5 0 0 0-.5-.5h-2a.5.5 0 0 1 0-1h2A1.5 1.5 0 0 1 14 6.5v8a1.5 1.5 0 0 1-1.5 1.5h-9A1.5 1.5 0 0 1 2 14.5v-8A1.5 1.5 0 0 1 3.5 5h2a.5.5 0 0 1 0 1z" />
                                                <path fill-rule="evenodd"
                                                    d="M7.646.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1-.708.708L8.5 1.707V10.5a.5.5 0 0 1-1 0V1.707L5.354 3.854a.5.5 0 1 1-.708-.708z" />
                                            </svg>
                                        </a>
                                    <?php endif; ?>

                                    <a href="#" class="supprimer" data-id-avis="<?= $a->id_avis ?>" data-id-utilisateur="<?= $a->id_utilisateur ?>" data-csrf_token="<?= $token ?>">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
                                            <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5M8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5m3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0" />
                                        </svg>
                                    </a>
                                </div>
                            <?php endif; ?>
                        </li>
                    <?php endforeach; ?>
                    <div id="modalAvis" class="modals" style="display:none;">
                        <div class="modal-content-update">
                            <span class="close">&times;</span>
                            <form id="formUpdateAvis">
                                <h2 style="color: darkgoldenrod;">Modifier votre avis</h2>

                                <label for="editRate" style="color: black;">Note :</label>
                                <div class="stars" id="editStars">
                                    <?php for ($i = 1; $i <= 5; $i++) : ?>
                                        <span class="star" data-value="<?= $i ?>">★</span>
                                    <?php endfor; ?>
                                </div>
                                <input type="hidden" name="rate" id="editRate">

                                <label for="editComment" style="color: black;">Commentaire :</label>
                                <textarea name="comment" id="editComment" rows="4" style="outline: none; border-radius:10px;"></textarea>

                                <input type="hidden" name="id_avis" id="editIdAvis">
                                <input type="hidden" name="id_utilisateur" id="editIdUtilisateur">
                                <input type="hidden" name="id_vehicule" id="editIdVehicule">
                                <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($token) ?>">

                                <button type="submit">Mettre à jour</button>
                            </form>
                        </div>
                    </div>

                </ul>
            <?php else : ?>
                <p>Aucun avis pour ce véhicule.</p>
            <?php endif; ?>
        </div>

    </div>

    <div class="vehicule-actions">
        <a href="index.php?controller=Vehicule&action=showCar" class="btn-back">Revenir à la liste des véhicules</a>
        <?php if ($vehicule->statut === 'Maintenance') : ?>
            <small style="font-style: italic;">Ce véhicule est actuellement indisponible</small>
        <?php else : ?>
            <a href="index.php?controller=Demande_reservation&action=createForm&id_vehicule=<?= $vehicule->id_vehicule ?>" class="btn-back">Réserver ce véhicule</a>
        <?php endif; ?>
    </div>
</section>
<?php $scripts = ["Ajax/avisUpdate", "Ajax/avisAjax", "Ajax/deleteAvis"]; ?>