<?php
session_start();

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
