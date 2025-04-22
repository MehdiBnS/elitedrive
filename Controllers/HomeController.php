<?php
namespace elitedrive\Controllers;
/**
 * Class HomeController
 * Gère les actions de la page d'accueil
 */
class HomeController extends Controller
{
    //homeAction -----------------
    //----------------------------
    public function homeAction()//Affichage de la page homeAction
    {
        $this->render('Home/homeAction');
       
    }
    
    public function contactAction()//Affichage de la page contactAction
    {
        $this->render('Home/contactAction');
    }

    public function aboutAction()//Affichage de la page aboutAction
    {
        $this->render('Home/aboutAction');
    }
}