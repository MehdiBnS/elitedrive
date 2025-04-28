<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Réservation Refusée</title>
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
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <h1>Réservation Refusée</h1>
        </div>
        <div class="content">
            <p>Bonjour {{prenom}} {{nom}},</p>
            <p>Nous vous informons que votre demande de réservation pour le véhicule <strong>{{marque}} {{modele}}</strong> a été <strong>refusée</strong>.</p>
            <p>Nous vous invitons à consulter notre site pour d'autres véhicules disponibles.</p>
            <p>Pour toute information concernant ce refus, merci de nous contacter directement par téléphone ou via notre formulaire en ligne, en précisant le véhicule concerné par votre demande.</p>

            <p>Merci pour votre compréhension.</p>
        </div>
        <div class="footer">
            EliteDrive © 2025 — Tous droits réservés.
        </div>
    </div>
</body>

</html>