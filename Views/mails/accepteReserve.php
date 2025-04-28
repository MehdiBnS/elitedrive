<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Réservation Acceptée</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 100%;
            max-width: 600px;
            margin: 0 auto;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .header {
            background-color: darkgoldenrod;
            padding: 20px;
            text-align: center;
            border-radius: 8px 8px 0 0;
        }

        .header h1 {
            margin: 0;
            color: #fff;
        }

        .content {
            padding: 20px;
        }

        .footer {
            background-color: darkgoldenrod;
            padding: 10px;
            text-align: center;
            font-size: 12px;
            color: #fff;
        }

        a {
            color: #007BFF;
            text-decoration: none;
        }

        ul {
            padding-left: 20px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <h1>Réservation Acceptée</h1>
        </div>
        <div class="content">
            <p>Bonjour {{prenom}} {{nom}},</p>
            <p>Votre demande de réservation a été <strong>acceptée</strong> avec succès.</p>
            <p>Voici les détails :</p>
            <ul>
                <li><strong>Véhicule :</strong> {{marque}} {{modele}}</li>
                <li><strong>Forfait :</strong> {{forfait}}</li>
                <li><strong>Montant :</strong> {{montant}} €</li>
                <li><strong>Date de début :</strong> {{date_debut}}</li>
                <li><strong>Date de fin :</strong> {{date_fin}}</li>
            </ul>
            <p>Merci pour votre confiance et à bientôt sur EliteDrive !</p>
            <small>Pour toute question, n'hésitez pas à nous contacter.</small><br>
            <small>Votre véhicule sera disponible à partir du {{date_debut}}. Merci de vous présenter muni de votre permis de conduire, d’un passeport ou d’une carte d’identité, ainsi que d’un chéquier ou d’une carte bancaire.</small><br>
            <small>En cas d’absence le jour du début de la réservation, le véhicule restera réservé à votre nom et les jours seront facturés. Merci de nous prévenir au moins deux jours à l’avance afin d’éviter toute facturation inutile.</small>

        </div>
        <div class="footer">
            EliteDrive © 2025 — Tous droits réservés.
        </div>
    </div>
</body>

</html>