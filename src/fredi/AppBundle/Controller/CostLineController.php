<?php

namespace fredi\AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use fredi\AppBundle\Entity\CostLine;
use fredi\AppBundle\Form\CostLineType;
use fredi\AppBundle\Entity\CostUser;
use fredi\AppBundle\Controller\AssociationController;
use Symfony\Component\HttpFoundation\Session\Session;
use fredi\AppBundle\Traits\GetAssociationsTrait;

/**
 * CostLine controller.
 *
 */
class CostLineController extends Controller
{
    use GetAssociationsTrait;

    /**
     * Lists all CostLine entities.
     *
     */
    public function indexAction(Request $request, $associationUniqueId)
    {
        $em = $this->getDoctrine()->getManager();

        $session = new Session;

        if($session->get('association') === null || $session->get('association') === '') {
            $associations = $this->getAssociations();
            return $this->render('frediAppBundle:association:select.html.twig', array(
                'associations' => $associations
            ));
        }

        $costLines = $em->getRepository('frediAppBundle:CostLine')->findAll();
        return $this->render('frediAppBundle:costline:index.html.twig', array(
            'costLines' => $costLines, 'associationUniqueId' => $associationUniqueId,
        ));
    }

    /**
     * Creates a new CostLine entity.
     *
     */
    public function newAction(Request $request, $associationUniqueId)
    {
        $costLine = new CostLine();
        $user = new CostUser();

        $form = $this->createForm('fredi\AppBundle\Form\CostLineType', $costLine);
        $form->handleRequest($request);

        $session = new Session;

        if($session->get('association') === null || $session->get('association') === '') {

            $associations = $this->getAssociations();

            if($associations === []) {
                $this->addFlash('notice', 'You must create a association first to add clients to it');
                return $this->redirectToRoute('fredi_association_new');
            }
            return $this->render('frediAppBundle:association:select.html.twig', array(
                'associations' => $associations
            ));
        }
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $association = $em->getRepository('frediAppBundle:Association')->findByUniqueId($associationUniqueId);
            $costLine->setAssociation($association[0]);
            $user->setCost($costLine->getCost());
            $user->setUser($this->getUser());
            $em->persist($costLine);
            $em->persist($user);
            $em->flush();

            return $this->redirectToRoute('costline_show', array('id' => $costLine->getId(), 'associationUniqueId' => $associationUniqueId));
        }

        return $this->render('frediAppBundle:costline:new.html.twig', array(
            'costLine' => $costLine,
            'form' => $form->createView(),
            'associationUniqueId' => $associationUniqueId,
        ));
    }

    /**
     * Finds and displays a CostLine entity.
     *
     */
    public function showAction(CostLine $costLine, $associationUniqueId)
    {
        $associations = $this->getAssociations();

        if(!in_array($costLine->getAssociation(), $associations)) {
            throw $this->createNotFoundException("We can't find this association");
        }
        $deleteForm = $this->createDeleteForm($costLine, $associationUniqueId);
        return $this->render('frediAppBundle:costline:show.html.twig', array(
            'costLine' => $costLine,
            'delete_form' => $deleteForm->createView(),
            'associationUniqueId' => $associationUniqueId,
        ));
    }

    /**
     * Displays a form to edit an existing CostLine entity.
     *
     */
    public function editAction(Request $request, CostLine $costLine, $associationUniqueId)
    {
        $associations = $this->getAssociations();

        if(!in_array($costLine->getCompany(), $associations)) {
            throw $this->createNotFoundException("We can't find this user");
        }

        $deleteForm = $this->createDeleteForm($costLine, $associationUniqueId);
        $editForm = $this->createForm('fredi\AppBundle\Form\CostLineType', $costLine);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($costLine);
            $em->flush();
            return $this->redirectToRoute('costline_edit', array('id' => $costLine->getId(), 'associationUniqueId' => $associationUniqueId));
        }
        return $this->render('frediAppBundle:costline:edit.html.twig', array(
            'costLine' => $costLine,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
            'associationUniqueId' => $associationUniqueId,
        ));
    }

    /**
     * Deletes a CostLine entity.
     *
     */
    public function deleteAction(Request $request, CostLine $costLine, $associationUniqueId)
    {
        if($associationUniqueId === 'chooseAnAssociation') {
            // 'You need to choose an association first';
            $associations = $this->getAssociations();
            if(!in_array($costLine->getAssociation(), $associations)) {
                throw $this->createNotFoundException("We can't find this user");
            }
            return $this->render('frediAppBundle:association:select.html.twig', array(
                'associations' => $associations
            ));
        }
        $form = $this->createDeleteForm($costLine, $associationUniqueId);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($client);
            $em->flush();
        }
        return $this->redirectToRoute('costline_index', array('associationUniqueId' => $associationUniqueId));
    }

    /**
     * Creates a form to delete a CostLine entity.
     *
     * @param CostLine $costLine The CostLine entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(CostLine $costLine, $associationUniqueId)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('costline_delete', array('id' => $costLine->getId(), 'associationUniqueId' => $associationUniqueId)))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
