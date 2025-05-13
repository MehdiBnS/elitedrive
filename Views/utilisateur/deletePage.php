<div class="deletepage">
    <div class="info-1">
        <h1>Suppression de votre compte EliteDrive</h1>
        <h2>Bonjour <?= $_SESSION['nom'] . ' ' . $_SESSION['prenom'] ?>,</h2>
    </div>

    <div class="delete-section">
        <p>Vous êtes sur le point de <strong>supprimer définitivement</strong> votre compte utilisateur. Cette action est <span class="danger-text">irréversible</span>.</p>

        <div class="delete-box">
            <p><strong>Ce qui va se passer :</strong></p>
            <ul>
                <li>Votre compte sera immédiatement désactivé.</li>
                <li>Vos informations personnelles (nom, prénom, email, etc.) seront conservées pendant <strong>30 jours</strong> à des fins légales et de sécurité.</li>
                <li>Passé ce délai, elles seront automatiquement supprimées de façon permanente de nos bases de données.</li>
                <li>Toutes les réservations ou demandes associées seront également supprimées ou rendues anonymes.</li>
            </ul>
        </div>

        <div class="delete-confirm">
            <form action="index.php?controller=Utilisateur&action=delete&id_utilisateur=<?= $_SESSION['id_utilisateur'] ?>" onsubmit="return confirm('Souhaitez-vous vraiment supprimer votre compte ?')">
                <input type="hidden" name="csrf_token" value="<?= $token ?>">
                <button class="delete-btn" type="submit">Supprimer</button>
            </form>
        </div>

        <p class="info-footer">
            EliteDrive s'engage à respecter votre vie privée. Pour toute question, contactez notre support.
        </p>
    </div>
</div>