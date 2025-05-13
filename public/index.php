<?php
// protection des attaques avec des id dession invalide ou innexistant
// php sécurité session
//https://www.php.net/manual/fr/session.security.ini.php
ini_set('session.use_strict_mode', 1);
session_start();


//https://www.tutorialspoint.com/php/php_csrf.htm
//csrf token php
if (empty($_SESSION['crsf_token'])) {
    $_SESSION['crsf_token'] = bin2hex(random_bytes(32));
}



//https://www.php.net/manual/fr/session.security.ini.php
//php session inactivity timeout
$session_expiration = 1200;
if (!empty($_SESSION['id_utilisateur'])) {
if (isset($_SESSION['expiration'])) {
    if (time() - $_SESSION['expiration'] > $session_expiration) {
        session_unset();
        session_destroy();
        header('Location: index.php?controller=Home&action=homeAction&session=expired');
        exit;
    }
}
$_SESSION['expiration'] = time();
}

// Modifier nom autoloader
use elitedrive\Autoloader;
use elitedrive\Core\Router;

// Inclure l'autoloader avec un chemin absolu
include dirname(__DIR__) . '/Autoloader.php';

// Enregistrer l'autoloader
Autoloader::register();

require_once dirname(__DIR__) . '/vendor/autoload.php';

// Initialiser et appeler le routeur
$route = new Router();
$route->routes();
