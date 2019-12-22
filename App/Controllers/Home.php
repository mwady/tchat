<?php

namespace App\Controllers;

use \Core\View;

class Home extends \Core\Controller
{

    /**
     * Afficher la page d'accueil
     *
     * @return void
     */
    public function indexAction()
    {
        View::renderTemplate('Login/login.html');
    }
}
