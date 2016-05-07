<?php

namespace fredi\AppBundle\Controller;
use Symfony\Component\HttpFoundation\Session\Session;
use fredi\AppBundle\Traits\GetAssociationsTrait;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class AppController extends Controller
{
    use GetAssociationsTrait;

    public function landingAction()
    {
        $session = new Session;
        if($session->get('association') === NULL || $session->get('association') === '') {
            $associationUniqueId = 'chooseAnAssociation';
        } else {
            $associationUniqueId = $session->get('association')->getUniqueId();
        }
        return $this->render('frediAppBundle:App:landing.html.twig', array('associationUniqueId' => $associationUniqueId));
    }

    public function dockbarAction()

    {
        $session = new Session;

        $associations = $this->getAssociations();
        if($session->get('association') === NULL || $session->get('association') === '') {
            $associationUniqueId = 'chooseAnAssociation';
            $actualAssociation = NULL;
        } else {
            $actualAssociation = $session->get('association');
            $associationUniqueId = $session->get('association')->getUniqueId();
        }
        if($actualAssociation !== NULL) {
            foreach ($associations as $key => $value) {
                if($value->getId() === $actualAssociation->getId()) {
                    unset($associations[$key]);
                }
            }
        }
        return $this->render('frediAppBundle:App:dockbar.html.twig', array(
            'actualAssociation' => $actualAssociation,
            'associations' => $associations,
            'associationUniqueId' => $associationUniqueId,
        ));
    }
}
