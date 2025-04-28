<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenue chez EliteDrive !</title>
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
            color: white;
        }
        .content {
            padding: 20px;
        }
        .footer {
            background-color: darkgoldenrod;
            padding: 10px;
            text-align: center;
            font-size: 12px;
            color: white;
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
        <h1>Bienvenue chez EliteDrive</h1>
    </div>
    
    <div class="content">
        <h2>Bonjour et félicitations !</h2>
        <p>Votre compte a été créé avec succès. Vous faites désormais partie de la communauté EliteDrive !</p>
        <p>Voici quelques actions que vous pouvez effectuer dès maintenant :</p>
        <ul>
            <li><a href="index.php?controller=Vehicule&action=showCar">Parcourir les véhicules disponibles</a></li>
            <li>Vous pouvez désormais accéder à votre espace client directement dans le menu de la barre de navigation</li>
        </ul>
        <p>Si vous avez la moindre question, notre équipe est à votre écoute.</p>
        <p>À très bientôt,<br>L’équipe EliteDrive</p>
    </div>

    <div class="footer">
        <p>Merci de votre inscription ! EliteDrive © <?php echo date('Y'); ?></p>
    </div>
</div>

</body>
</html>
