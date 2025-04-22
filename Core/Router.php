<?php

namespace elitedrive\Core; // A modifier
// Déclaration du namespace

class Router
{
    // Propriétés ou attributs
    private $controller;
    private $action;

    // Méthode route pour déclarer le chemin prix
    public function routes()
    {
        $this->controller = isset($_GET['controller']) ? $_GET['controller'] : 'Home';
        $controller = 'elitedrive\\Controllers\\' . strval($this->controller) . 'Controller';


        // Puis on récupère l'action en get
        $this->action = isset($_GET['action']) ? $_GET['action'] : 'homeAction';

        // On instancie le controller
        $controller = new $controller();

        // Si la méthode récupérée existe dans le controller, alors on l'appelle
        if (method_exists($controller, $this->action)) {
            $controller->{$this->action}();
        } else {
            http_response_code(404);
            echo "<div class='alert alert-danger'><strong>Il y a eu un problème !</strong> La page recherchée n'existe pas.</div>";
            echo '<a href="index.php?controller=Main&action=home">Retour à l\'accueil</a>';
        }
    }
}

// permet de solliciter le contrôleur et la bonne action (méthode) à éxécuter
// Le routeur ne va chercher que dans les contrôleurs