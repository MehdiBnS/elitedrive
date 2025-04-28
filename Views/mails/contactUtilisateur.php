<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Demande de Contact - Confirmation</title>
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
            <h1>Demande de contact-{{nom}} {{prenom}}</h1>
        </div>

        <div class="content">
            <h1>Informations :</h1>

            <p><strong>Nom :</strong> {{nom}}</p>
            <p><strong>Prénom :</strong> {{prenom}}</p>
            <p><strong>Email :</strong> {{email}}</p>
            <h2><strong>Message :</strong></h2><br>
            <p> {{message}}</p>
        </div>

        <div class="footer">
            <p>EliteDrive © <?php echo date('Y') ?></p>
        </div>
    </div>

</body>

</html>
