<?php

namespace fredi\AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use fredi\AppBundle\Entity\CostLine;
use fredi\AppBundle\Form\CostLineType;
use fredi\AppBundle\Entity\CostUser;

/**
 * CostLine controller.
 *
 */
class CostLineController extends Controller
{
    /**
     * Lists all CostLine entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $costLines = $em->getRepository('frediAppBundle:CostLine')->findAll();

        return $this->render('frediAppBundle:costline:index.html.twig', array(
            'costLines' => $costLines,
        ));
    }

    /**
     * Creates a new CostLine entity.
     *
     */
    public function newAction(Request $request)
    {
        $costLine = new CostLine();
        $user = new CostUser();

        $form = $this->createForm('fredi\AppBundle\Form\CostLineType', $costLine);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $user->setCost($costLine->getCost());
            $user->setUser($this->getUser());
            $em->persist($costLine);
            $em->persist($user);
            $em->flush();

            return $this->redirectToRoute('costline_index', array('id' => $costLine->getCost()->getId()));
        }

        return $this->render('frediAppBundle:costline:new.html.twig', array(
            'costLine' => $costLine,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a CostLine entity.
     *
     */
    public function showAction(CostLine $costLine)
    {
        $deleteForm = $this->createDeleteForm($costLine);

        return $this->render('frediAppBundle:costline:show.html.twig', array(
            'costLine' => $costLine,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing CostLine entity.
     *
     */
    public function editAction(Request $request, CostLine $costLine)
    {
        $deleteForm = $this->createDeleteForm($costLine);
        $editForm = $this->createForm('fredi\AppBundle\Form\CostLineType', $costLine);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($costLine);
            $em->flush();

            return $this->redirectToRoute('costline_edit', array('id' => $costLine->getId()));
        }

        return $this->render('frediAppBundle:costline:edit.html.twig', array(
            'costLine' => $costLine,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a CostLine entity.
     *
     */
    public function deleteAction(Request $request, CostLine $costLine)
    {
        $form = $this->createDeleteForm($costLine);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($costLine);
            $em->flush();
        }

        return $this->redirectToRoute('costline_index');
    }

    /**
     * Creates a form to delete a CostLine entity.
     *
     * @param CostLine $costLine The CostLine entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(CostLine $costLine)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('costline_delete', array('id' => $costLine->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
