<?php

namespace fredi\AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use fredi\AppBundle\Entity\Cost;
use fredi\AppBundle\Form\CostType;

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
        $em = $this->getDoctrine()->getManager();

        $costs = $em->getRepository('frediAppBundle:Cost')->findAll();

        return $this->render('cost/index.html.twig', array(
            'costs' => $costs,
        ));
    }

    /**
     * Creates a new Cost entity.
     *
     */
    public function newAction(Request $request)
    {
        $cost = new Cost();
        $form = $this->createForm('fredi\AppBundle\Form\CostType', $cost);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($cost);
            $em->flush();

            return $this->redirectToRoute('cost_show', array('id' => $cost->getId()));
        }

        return $this->render('cost/new.html.twig', array(
            'cost' => $cost,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Cost entity.
     *
     */
    public function showAction(Cost $cost)
    {
        $deleteForm = $this->createDeleteForm($cost);

        return $this->render('cost/show.html.twig', array(
            'cost' => $cost,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Cost entity.
     *
     */
    public function editAction(Request $request, Cost $cost)
    {
        $deleteForm = $this->createDeleteForm($cost);
        $editForm = $this->createForm('fredi\AppBundle\Form\CostType', $cost);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($cost);
            $em->flush();

            return $this->redirectToRoute('cost_edit', array('id' => $cost->getId()));
        }

        return $this->render('cost/edit.html.twig', array(
            'cost' => $cost,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Cost entity.
     *
     */
    public function deleteAction(Request $request, Cost $cost)
    {
        $form = $this->createDeleteForm($cost);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($cost);
            $em->flush();
        }

        return $this->redirectToRoute('cost_index');
    }

    /**
     * Creates a form to delete a Cost entity.
     *
     * @param Cost $cost The Cost entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Cost $cost)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('cost_delete', array('id' => $cost->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
