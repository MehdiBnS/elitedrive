<?php
namespace elitedrive\Controllers;


class HomeController extends Controller
{
    public function homeAction()
    {
        $this->render('Home/homeAction');
       
    }
    
    public function contactAction()
    {
        $this->render('Home/contactAction');
    }

    public function aboutAction()
    {
        $this->render('Home/aboutAction');
    }
}