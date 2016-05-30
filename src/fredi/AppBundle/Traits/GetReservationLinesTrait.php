<?php

namespace fredi\AppBundle\Traits;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\HttpFoundation\Session\Session;

trait GetReservationLinesTrait
{
/**
     * Method to retrieve all reservations of a user
     * @return array ReservationLines
     */
    private function getReservationLines()
    {
        $em = $this->getDoctrine()->getManager();

        $ReservationLinesArray = [];

        if($this->getUser()) {
            $users = $em->getRepository('frediAppBundle:User')->findBy(array('id' => $this->getUser()->getId()));
            $user = $users[0];

            $reservationLines = $em->getRepository('frediAppBundle:UserReservation')->findByUser($user);

            foreach ($reservationLines as $reservationLine) {
                $reservationLinesArray[] = $reservationLine->getReservationLine();
            }
        }

        return $reservationLinesArray;
    }
}
