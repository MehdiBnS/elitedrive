<div id="wrapper-contact">
    <h1 class="contact-titre">Nos contacts</h1>
    <div id="contact-section">
        <div class="form-container" id="contact-form">
            <h2>Une question ?</h2>
            <form action="index.php?controller=Contact&action=contactUtilisateur" method="POST" class="generic-form">

                <div class="form-group">
                    <label for="nom">Nom</label>
                    <input type="text" name="nom" id="nom" class="form-input-contact">
                    <span class="error-message-contact"></span>
                </div>

                <div class="form-group">
                    <label for="prenom">Prénom</label>
                    <input type="text" name="prenom" id="prenom" class="form-input-contact">
                    <span class="error-message-contact"></span>
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" class="form-input-contact">
                    <span class="error-message-contact"></span>
                </div>

                <div class="form-group">
                    <label for="message">Message</label>
                    <textarea name="message" id="message" class="form-input-contact"></textarea>
                    <span class="error-message-contact"></span>
                </div>

                <button type="submit" class="form-button">Envoyer</button>
                    <span class="valid-message-contact" style="color: green;"></span>
            </form>
        </div>

        <div id="contact-texte">

            <h2>Service Client - EliteDrive</h2>
            <p>Chez <span>EliteDrive</span>, nous nous engageons à répondre à vos demandes dans les meilleurs délais. Tous les messages envoyés via notre formulaire de contact sont traités avec attention par notre équipe.</p>

            <p><span>Délai de réponse :</span> Nous vous garantissons une réponse sous 24 heures, du lundi au vendredi. Les demandes envoyées le week-end seront traitées dès le lundi suivant.</p>

            <p><span>Mode de contact :</span> Vous recevrez notre réponse directement à l’adresse e-mail indiquée dans le formulaire. Assurez-vous que celle-ci est correcte afin d’éviter tout retard.</p>

            <p><span>Suivi de votre demande :</span> Si vous ne recevez pas de réponse sous 24 heures, nous vous invitons à vérifier votre dossier spam ou courrier indésirable.</p>

            <p>Notre équipe reste disponible pour toute information complémentaire.</p>

        </div>

    </div>

    <div id="separate"></div>
    <h1 class="contact-titre">Venir nous rencontrer ?</h1>
    <div id="localisation-section">


        <div id="localisation-texte">
            <h2>Bienvenue à <span>Monaco</span></h2>
            <p>Monaco est une ville <span>magnifique</span>, réputée pour son <span>glamour</span>, sa <span>beauté naturelle</span> et son <span>luxe</span>. Située sur la <span>Côte d'Azur</span>, cette petite <span>principauté</span> offre une vue imprenable sur la <span>mer Méditerranée</span> et un <span>climat agréable</span> toute l'année. Ses célèbres rues bordées de <span>palmiers</span>, son architecture élégante et son ambiance unique en font une destination prisée des voyageurs du monde entier.</p>
            <p>La ville est aussi connue pour son <span>casino de Monte-Carlo</span>, son <span>musée océanographique</span> et son <span>port de plaisance</span> où de magnifiques <span>yachts</span> sont amarrés. Son environnement paisible et ses <span>attractions exceptionnelles</span> font de Monaco un lieu de rêve à visiter ou à vivre.</p>
        </div>
        <div id="localisation-map">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2882.4862556057565!2d7.426242312557634!3d43.74199827097755!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x12cdc27d15d410e3%3A0xbcebde4f620599f8!2s5%20Av.%20des%20Citronniers%203%2C%2098000%20Monaco!5e0!3m2!1sfr!2sfr!4v1743067718001!5m2!1sfr!2sfr" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
    </div>
    <div id="separate"></div>
    <h1 class="contact-titre">Nous rejoindre ?</h1>

    <div id="joins-section">

        <div id="joins-infos">
            <img src="../public/img/contact/monaco.jpg" alt="Monaco" />
        </div>


        <div id="joins-texte">
            <p><span>Modalités de recrutement :</span></p>
            <p>Nous recherchons des profils présentant une <span>excellente présentation</span>, une <span>élocution irréprochable</span>, et un sens du <span>service incomparable</span>. Il est essentiel d'être <span>bien habillé</span>, avec des tenues <span>soignées et élégantes</span>, à même de refléter les <span>valeurs de prestige</span> et de <span>raffinement</span> de notre entreprise.</p>
            <p>Nous attachons une grande importance à la <span>politesse</span>, au <span>respect</span> et à la <span>bienveillance</span> dans toutes nos interactions. Avoir un comportement <span>avenant</span>, <span>empathique</span> et <span>digne</span> est crucial pour réussir dans notre équipe.</p>
            <p>Des qualités comme la <span>ponctualité</span>, la <span>discrétion</span>, et une <span>attitude proactive</span> sont également des atouts importants. Enfin, une forte capacité d’adaptation et une volonté constante d’<span>excellence</span> seront les clés de votre succès au sein de notre équipe.</p>
            <p> Nous contacter sur : 
                <a href="mailto:gestion@elitedrive.fr" class="footer-email">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-envelope" viewBox="0 0 16 16">
                        <path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V4zm2 0v8h12V4H2z" />
                    </svg>
                    recrutement@elitedrive.fr
                </a>
            </p>
        </div>

    </div>
</div>