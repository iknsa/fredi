<?php

namespace fredi\AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use fredi\AppBundle\Entity\ReservationLine;
use fredi\AppBundle\Form\ReservationLineType;

/**
 * ReservationLine controller.
 *
 */
class ReservationLineController extends Controller
{
    /**
     * Lists all ReservationLine entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $reservationLines = $em->getRepository('frediAppBundle:ReservationLine')->findAll();

        return $this->render('reservationline/index.html.twig', array(
            'reservationLines' => $reservationLines,
        ));
    }

    /**
     * Creates a new ReservationLine entity.
     *
     */
    public function newAction(Request $request)
    {
        $reservationLine = new ReservationLine();
        $form = $this->createForm('fredi\AppBundle\Form\ReservationLineType', $reservationLine);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($reservationLine);
            $em->flush();

            return $this->redirectToRoute('reservationline_show', array('id' => $reservationLine->getId()));
        }

        return $this->render('reservationline/new.html.twig', array(
            'reservationLine' => $reservationLine,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a ReservationLine entity.
     *
     */
    public function showAction(ReservationLine $reservationLine)
    {
        $deleteForm = $this->createDeleteForm($reservationLine);

        return $this->render('reservationline/show.html.twig', array(
            'reservationLine' => $reservationLine,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing ReservationLine entity.
     *
     */
    public function editAction(Request $request, ReservationLine $reservationLine)
    {
        $deleteForm = $this->createDeleteForm($reservationLine);
        $editForm = $this->createForm('fredi\AppBundle\Form\ReservationLineType', $reservationLine);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($reservationLine);
            $em->flush();

            return $this->redirectToRoute('reservationline_edit', array('id' => $reservationLine->getId()));
        }

        return $this->render('reservationline/edit.html.twig', array(
            'reservationLine' => $reservationLine,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a ReservationLine entity.
     *
     */
    public function deleteAction(Request $request, ReservationLine $reservationLine)
    {
        $form = $this->createDeleteForm($reservationLine);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($reservationLine);
            $em->flush();
        }

        return $this->redirectToRoute('reservationline_index');
    }

    /**
     * Creates a form to delete a ReservationLine entity.
     *
     * @param ReservationLine $reservationLine The ReservationLine entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(ReservationLine $reservationLine)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('reservationline_delete', array('id' => $reservationLine->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
