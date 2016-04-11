<?php

namespace fredi\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('frediAppBundle:Default:index.html.twig');
    }
}
