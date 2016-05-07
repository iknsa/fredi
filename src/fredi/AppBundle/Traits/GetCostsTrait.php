<?php

namespace fredi\AppBundle\Traits;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\HttpFoundation\Session\Session;

trait GetCostsTrait
{
/**
     * Method to retrieve all costs of a user
     * @return array Costs
     */
    private function getCosts()
    {
        $em = $this->getDoctrine()->getManager();

        $costsArray = [];

        if($this->getUser()) {
            $users = $em->getRepository('frediAppBundle:User')->findBy(array('id' => $this->getUser()->getId()));
            $user = $users[0];

            $costs = $em->getRepository('frediAppBundle:CostUser')->findByUser($user);

            foreach ($costs as $cost) {
                $costsArray[] = $cost->getCostLine();
            }
        }

        return $costsArray;
    }
}
