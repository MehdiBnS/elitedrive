<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenue à notre Newsletter !</title>
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
        <h1>Bienvenue dans la Newsletter d'EliteDrive</h1>
    </div>
    
    <div class="content">
        <h2>Bonjour et merci de vous être abonné(e) !</h2>
        <p>Nous sommes ravis de vous accueillir dans notre communauté ! Vous recevrez régulièrement des informations sur nos dernières offres et nouveautés.</p>
        <p>Pour commencer, voici quelques liens utiles :</p>
        <ul>
            <li><a href="index.php?controller=Vehicule&action=showCar">Découvrez nos véhicules</a></li>
            <li><a href="index.php?controller=Utilisateur&action=subForm">Nouveau sur le site ?</a></li>
        </ul>
        <p>Si vous avez des questions, n'hésitez pas à nous contacter !</p>
        <p>Cordialement,<br>L'équipe d'EliteDrive</p>
    </div>

    <div class="footer">
        <p>Vous recevez cet e-mail car vous vous êtes inscrit(e) à notre newsletter. Si vous souhaitez vous désabonner, cliquez <a href="#">ici</a>.</p>
    </div>
</div>

</body>
</html>
