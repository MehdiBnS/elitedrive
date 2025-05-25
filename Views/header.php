<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../public/style/style.css">
    <link rel="stylesheet" href="../public/style/responsive.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="icon" href="../public/img/favicon.ico" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <title>EliteDrive</title>
</head>

<body>
    <div class="loading-container">
        <div class="loading"></div>
    </div>

    <header>
        <div id="container-logo">
            <a href="index.php?controller=Utilisateur&action=connectForm" class="icon-link">
                <img class="mobile-icon left-icon" src="../public/img/header/user.svg" alt="Left Icon">
            </a>



            <a href="index.php?controller=Home&action=homeAction">
                <img id="logo" src="../public/img/header/ELITE.png" alt="Logo">
            </a>
            <img class="mobile-icon burger-icon" src="../public/img/header/menu.svg" alt="Burger Menu">
        </div>
        <nav id="navBar">
            <ul id="menuNav">
                <li class="listeMenu"><a class="lienMenu" href="index.php?controller=Home&action=homeAction">Accueil</a></li>
                <li id="menuNosLocations" class="listeMenu">
                    <a class="lienMenu" href="#">Nos locations
                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-down" viewBox="0 0 24 24">
                            <path d="M6 9l6 6 6-6"></path>
                        </svg>
                    </a>
                    <ul class="sous-menu">
                        <li><a class="lienMenu" href="index.php?controller=Vehicule&action=showCar&id_categorie=6">Nos voitures</a></li>
                        <li><a class="lienMenu" href="index.php?controller=Vehicule&action=showCar&id_categorie=7">Nos utilitaires</a></li>
                        <li><a class="lienMenu" href="index.php?controller=Vehicule&action=showCar&id_categorie=7">Nos limousines</a></li>
                        <li><a class="lienMenu" href="index.php?controller=Vehicule&action=showCar">Voir tout</a></li>
                    </ul>
                </li>

                <li class="listeMenu"><a class="lienMenu" href="index.php?controller=Home&action=contactAction">Contact</a></li>
                <li class="listeMenu"><a class="lienMenu" href="index.php?controller=Home&action=aboutAction">A propos</a></li>
                <?php if (isset($_SESSION['id_utilisateur'])): ?>
                    <?php if ($_SESSION['role'] == 0): ?>
                        <li class="btnConnect" class="listeMenu">
                            <a class="lienMenu" href="index.php?controller=Utilisateur&action=showProfile">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-person-fill" viewBox="0 0 16 16">
                                    <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6" />
                                </svg>
                                Mon compte
                            </a>
                            <a class="lienMenu" href="index.php?controller=Utilisateur&action=disconnect">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box-arrow-in-left" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M10 3.5a.5.5 0 0 0-.5-.5h-8a.5.5 0 0 0-.5.5v9a.5.5 0 0 0 .5.5h8a.5.5 0 0 0 .5-.5v-2a.5.5 0 0 1 1 0v2A1.5 1.5 0 0 1 9.5 14h-8A1.5 1.5 0 0 1 0 12.5v-9A1.5 1.5 0 0 1 1.5 2h8A1.5 1.5 0 0 1 11 3.5v2a.5.5 0 0 1-1 0z" />
                                    <path fill-rule="evenodd" d="M4.146 8.354a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H14.5a.5.5 0 0 1 0 1H5.707l2.147 2.146a.5.5 0 0 1-.708.708z" />
                                </svg>

                            </a>
                        </li>
                    <?php elseif ($_SESSION['role'] == 1): ?>
                        <li class="btnConnect" class="listeMenu">
                            <a class="lienMenu" href="index.php?controller=Admin&action=backOffice">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-person-fill" viewBox="0 0 16 16">
                                    <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6" />
                                </svg>
                                Gestion du site
                            </a>
                            <a class="lienMenu" href="index.php?controller=Utilisateur&action=disconnect">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box-arrow-in-left" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M10 3.5a.5.5 0 0 0-.5-.5h-8a.5.5 0 0 0-.5.5v9a.5.5 0 0 0 .5.5h8a.5.5 0 0 0 .5-.5v-2a.5.5 0 0 1 1 0v2A1.5 1.5 0 0 1 9.5 14h-8A1.5 1.5 0 0 1 0 12.5v-9A1.5 1.5 0 0 1 1.5 2h8A1.5 1.5 0 0 1 11 3.5v2a.5.5 0 0 1-1 0z" />
                                    <path fill-rule="evenodd" d="M4.146 8.354a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H14.5a.5.5 0 0 1 0 1H5.707l2.147 2.146a.5.5 0 0 1-.708.708z" />
                                </svg>

                            </a>
                        </li>
                    <?php endif; ?>
                <?php else: ?>
                    <li class="btnConnect" class="listeMenu">
                        <a class="lienMenu" href="index.php?controller=Utilisateur&action=connectForm">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-person-fill" viewBox="0 0 16 16">
                                <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6" />
                            </svg>
                            Se connecter
                        </a>
                    </li>
                <?php endif; ?>
            </ul>
        </nav>
    </header>


    <main>