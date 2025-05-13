<?php if ($reservations) : ?>
    <div class="order-admin">
        <h1 style="color: black;">Réservations</h1>
        <div class="navbar-admin">
            <div class="order-admin-button">
                <a href="index.php?controller=Admin&action=backOffice">Retour</a>
            </div>
            <form method="post" action="index.php?controller=Admin&action=orderReservations" class="filter-form">
                <input type="text" name="search" placeholder="Rechercher une réservation" value="<?= htmlspecialchars($search ?? '') ?>">
                <button type="submit" class="filter-button">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                        <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0" />
                    </svg>
                </button>
                <a href="index.php?controller=Admin&action=orderReservations" style="margin-left: 10px;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-arrow-counterclockwise" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M8 3a5 5 0 1 1-4.546 2.914.5.5 0 0 0-.908-.417A6 6 0 1 0 8 2z" />
                        <path d="M8 4.466V.534a.25.25 0 0 0-.41-.192L5.23 2.308a.25.25 0 0 0 0 .384l2.36 1.966A.25.25 0 0 0 8 4.466" />
                    </svg>
                </a>
            </form>
        </div>
        <?php if (isset($_SESSION['message'])) : ?>
            <p style="color: green;"> <?= htmlspecialchars($_SESSION['message']) ?> </p>
            <?php unset($_SESSION['message']); ?>
        <?php else : ?>
            <p></p>
        <?php endif; ?>
        <table id="reserveTable">
            <thead>
                <tr>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Email</th>
                    <th>Ville</th>
                    <th>Numéro de téléphone</th>
                    <th>Véhicule</th>
                    <th>Année du véhicule</th>
                    <th>Description du véhicule</th>
                    <th>Montant</th>
                    <th>Forfait</th>
                    <th>Date</th>
                    <th>Statut</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($reservations as $reservation): ?>
                    <?php
                    $clear = $reservation->date_fin < date('Y-m-d H:i:s');
                    ?>
                    <tr style="<?= $clear ? 'background-color: #d3f9d8;' : '' ?>">
                        <td><?= htmlspecialchars($reservation->nom) ?></td>
                        <td><?= htmlspecialchars($reservation->prenom) ?></td>
                        <td><?= htmlspecialchars($reservation->email) ?></td>
                        <td><?= htmlspecialchars($reservation->ville) ?></td>
                        <td><?= htmlspecialchars($reservation->numero_telephone) ?></td>
                        <td><?= htmlspecialchars($reservation->vehicule_nom) ?></td>
                        <td><?= htmlspecialchars($reservation->annee) ?></td>
                        <td><?= htmlspecialchars($reservation->description) ?></td>
                        <td><?= htmlspecialchars($reservation->montant) ?> €</td>
                        <td><?= htmlspecialchars($reservation->forfait) ?></td>
                        <td><?= htmlspecialchars($reservation->date_debut) ?> au <?= htmlspecialchars($reservation->date_fin) ?></td>
                        <td>
                            <form action="index.php?controller=Admin&action=updateReservationStatut" method="post">
                                <input type="hidden" name="id_reservation" value="<?= htmlspecialchars($reservation->id_reservation) ?>">
                                <input type="hidden" name="id_vehicule" value="<?= htmlspecialchars($reservation->id_vehicule) ?>">
                                <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($_SESSION['csrf_token']) ?>" readonly>
                                <select name="statut" class="statut-select" onchange="this.form.submit()">
                                    <option value="Réserver" <?= $reservation->statut == 'Réserver' ? 'selected' : '' ?>>Réserver</option>
                                    <option value="Loué" <?= $reservation->statut == 'Loué' ? 'selected' : '' ?>>Loué</option>
                                    <option value="Maintenance" <?= $reservation->statut == 'Maintenance' ? 'selected' : '' ?>>Maintenance</option>
                                    <option value="Disponible" <?= $reservation->statut == 'Disponible' ? 'selected' : '' ?>>Rendu</option>
                                </select>
                            </form>
                        </td>
                        <td>
                            <form method="post" action="index.php?controller=Admin&action=createArchive" class="archive-form">
                                <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($_SESSION['csrf_token']) ?>" readonly>
                                <input type="hidden" name="nom" value="<?= htmlspecialchars($reservation->nom) ?>">
                                <input type="hidden" name="prenom" value="<?= htmlspecialchars($reservation->prenom) ?>">
                                <input type="hidden" name="email" value="<?= htmlspecialchars($reservation->email) ?>">
                                <input type="hidden" name="ville" value="<?= htmlspecialchars($reservation->ville) ?>">
                                <input type="hidden" name="numero_telephone" value="<?= htmlspecialchars($reservation->numero_telephone) ?>">
                                <input type="hidden" name="nom_vehicule" value="<?= htmlspecialchars($reservation->vehicule_nom) ?>">
                                <input type="hidden" name="modele" value="<?= htmlspecialchars($reservation->modele_nom) ?>">
                                <input type="hidden" name="marque" value="<?= htmlspecialchars($reservation->marque_nom) ?>">
                                <input type="hidden" name="categorie_vehicule" value="<?= htmlspecialchars($reservation->categorie_nom) ?>">
                                <input type="hidden" name="montant" value="<?= htmlspecialchars($reservation->montant) ?>">
                                <input type="hidden" name="date" value="<?= htmlspecialchars($reservation->date_debut) ?>">
                                <button type="submit" class="archive-btn">Archiver</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
<?php else: ?>
    <div class="order-admin">
    <div class="order-admin-button">
                <a href="index.php?controller=Admin&action=backOffice">Retour</a>
                Aucune réservation trouvée.
            </div>
      
    </div>
<?php endif; ?>

<?php $scripts = ["admin/searchReservation", "admin/setArchiveAdd"]; ?>