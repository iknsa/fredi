<?php

namespace fredi\AppBundle\Traits;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\HttpFoundation\Session\Session;

trait GetAssociationsTrait
{
    /**
     * Method to retrieve all associations of a user
     * @return array Associations
     */
    private function getAssociations()
    {
        $em = $this->getDoctrine()->getManager();

        $associationsArray = [];

        if($this->getUser()) {
            $users = $em->getRepository('frediAppBundle:User')->findBy(array('id' => $this->getUser()->getId()));
            $user = $users[0];

            $associations = $em->getRepository('frediAppBundle:AssociationUser')->findByUser($user);

            foreach ($associations as $association) {
                $associationsArray[] = $association->getAssociation();
            }
        }
        return $associationsArray;
    }
}
