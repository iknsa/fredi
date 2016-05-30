<?php

namespace fredi\AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use fredi\AppBundle\Entity\Reservation;
use fredi\AppBundle\Form\ReservationType;
use fredi\AppBundle\Entity\UserReservation;
use fredi\AppBundle\Traits\GetAssociationsTrait;
use fredi\AppBundle\Traits\GetReservationLinesTrait;
use Symfony\Component\HttpFoundation\Session\Session;
use fredi\AppBundle\Entity\ReservationLine;
use fredi\AppBundle\Controller\AssociationController;

/**
 * Reservation controller.
 *
 */
class ReservationController extends Controller
{
    use GetAssociationsTrait;
    use GetReservationLinesTrait;

    /**
     * Lists all Reservation entities.
     *
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $session = new Session;

        $association = $em->getRepository('frediAppBundle:Association')->findAll();
        $reservations = $em->getRepository('frediAppBundle:Reservation')->findByAssociation($association);

        return $this->render('frediAppBundle:reservation:index.html.twig', array(
            'reservations' => $reservations,
        ));
    }

    /**
     * Creates a new Reservation entity.
     *
     */
    public function newAction(Request $request)
    {
        $reservation = new Reservation();
        $user = new UserReservation();

        $form = $this->createForm('fredi\AppBundle\Form\ReservationType', $reservation);
        $form->handleRequest($request);

        $session = new Session;


        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $association = $em->getRepository('frediAppBundle:Association')->findAll();
            $reservation->setAssociation($association[0]);
            $user->setReservationLine($reservation->getReservationLine());
            $user->setUser($this->getUser());
            $em->persist($reservation);
            $em->persist($user);
            $em->flush();

            return $this->redirectToRoute('reservation_show', array('id' => $reservation->getId()));
        }

        return $this->render('frediAppBundle:reservation:new.html.twig', array(
            'reservation' => $reservation,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Reservation entity.
     *
     */
    public function showAction(Reservation $reservation)
    {
        $deleteForm = $this->createDeleteForm($reservation);

        return $this->render('frediAppBundle:reservation:show.html.twig', array(
            'reservation' => $reservation,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Reservation entity.
     *
     */
    public function editAction(Request $request, Reservation $reservation)
    {
        $deleteForm = $this->createDeleteForm($reservation);
        $editForm = $this->createForm('fredi\AppBundle\Form\ReservationType', $reservation);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($reservation);
            $em->flush();

            return $this->redirectToRoute('reservation_edit', array('id' => $reservation->getId()));
        }

        return $this->render('reservation/edit.html.twig', array(
            'reservation' => $reservation,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Reservation entity.
     *
     */
    public function deleteAction(Request $request, Reservation $reservation)
    {
        $form = $this->createDeleteForm($reservation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($reservation);
            $em->flush();
        }

        return $this->redirectToRoute('reservation_index');
    }

    /**
     * Creates a form to delete a Reservation entity.
     *
     * @param Reservation $reservation The Reservation entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Reservation $reservation)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('reservation_delete', array('id' => $reservation->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
