<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmation de votre message - EliteDrive</title>
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

        blockquote {
            padding: 10px;
            background-color: #f9f9f9;
            border-left: 5px solid darkgoldenrod;
            margin: 10px 0;
            font-style: italic;
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
            <h1>Bonjour {{prenom}},</h1>
        </div>

        <div class="content">
            <p>Nous avons bien reçu votre message :</p>

            <blockquote>
                {{message}}
            </blockquote>

            <p>Notre équipe vous répondra dans les plus brefs délais.</p>
            <p>Merci de nous avoir contacté,<br>L'équipe EliteDrive</p>
        </div>

        <div class="footer">
            <p>EliteDrive © <?php echo date('Y') ?></p>
        </div>
    </div>

</body>

</html>