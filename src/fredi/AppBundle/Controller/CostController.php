<?php

namespace fredi\AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use fredi\AppBundle\Entity\CostLine;
use fredi\AppBundle\Form\CostTypeLine;
use fredi\AppBundle\Entity\CostUser;

/**
 * Cost controller.
 *
 */
class CostController extends Controller
{
    /**
     * Lists all Cost entities.
     *
     */
    public function indexAction()
    {
        $costs = $this->getCosts();

        return $this->render('frediAppBundle:cost:index.html.twig', array(
            'costs' => $costs,
        ));
    }

    /**
     * Creates a new Cost entity.
     *
     */
    public function newAction()
    {
        return $this->render('frediAppBundle:cost:new.html.twig', array());
    }

    /**
     * Finds and displays a Cost entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $cost = $em->getRepository('frediAppBundle:Cost')->findById($id);

        $costline = $em->getRepository("frediAppBundle:CostLine")->findByCost($cost);

        return $this->render('frediAppBundle:cost:show.html.twig', array(
            'costline' => $costline[0]
        ));

    }

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
                $costsArray[] = $cost->getCost();
            }
        }

        return $costsArray;
    }
}
