<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmation de votre demande de réservation - EliteDrive</title>
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
        }
        .content {
            padding: 20px;
        }
        .footer {
            background-color: darkgoldenrod;
            padding: 10px;
            text-align: center;
            font-size: 12px;
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
        <h1>Confirmation de votre demande de réservation - EliteDrive</h1>
    </div>
    
    <div class="content">
        <h2>Bonjour {{prenom}} {{nom}},</h2>
        <p>Nous avons bien reçu votre demande de réservation. Voici les détails de votre demande :</p>
        
        <h3>Informations sur votre demande :</h3>
        <ul>
            <li><strong>Message :</strong> {{message}}</li>
            <li><strong>Véhicule :</strong> {{modele}} ({{marque}})</li>
            <li><strong>Forfait choisi :</strong> {{quantite}} {{forfait}} </li>
            <li><strong>Durée de la réservation :</strong> du {{date_debut}} au {{date_fin}}</li>
            <li><strong>Montant total :</strong> {{montant}} €</li>
        </ul>
        
        <h3>Informations supplémentaires :</h3>
        <ul>
            <li><strong>Téléphone :</strong> {{tel}}</li>
        </ul>

        <p>Nous vous tiendrons informé(e) de l'évolution de votre demande.</p>
        
        <p>Si vous avez des questions ou des modifications à apporter, n'hésitez pas à nous contacter.</p>

        <p>Cordialement,<br>L'équipe d'EliteDrive</p>
    </div>

    <div class="footer">
        <p>Vous recevez cet e-mail car vous avez effectué une demande de réservation sur notre site. Si vous souhaitez annuler votre réservation, veuillez nous contacter immédiatement.</p>
    </div>
</div>

</body>
</html>
