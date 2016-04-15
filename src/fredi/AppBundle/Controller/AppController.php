<?php

namespace fredi\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class AppController extends Controller
{
    public function landingAction()
    {
        return $this->render('frediAppBundle:App:landing.html.twig');
    }

    public function dockbarAction()
    {
        return $this->render('frediAppBundle:App:dockbar.html.twig');
    }
}
