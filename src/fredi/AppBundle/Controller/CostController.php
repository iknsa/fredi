<?php

namespace fredi\AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use fredi\AppBundle\Entity\CostLine;
use fredi\AppBundle\Form\CostTypeLine;
use fredi\AppBundle\Entity\CostUser;
use fredi\AppBundle\Traits\GetAssociationsTrait;
use fredi\AppBundle\Traits\GetTreasurerAssociationsTrait;
use Symfony\Component\HttpFoundation\Session\Session;

/**
 * Cost controller.
 *
 */
class CostController extends Controller
{
    use GetAssociationsTrait;
    use GetTreasurerAssociationsTrait;

    /**
     * Lists all Cost entities.
     *
     */
    public function indexAction(Request $request, $associationUniqueId)
    {
        $em = $this->getDoctrine()->getManager();

        $session = new Session;

        if($session->get('association') === null || $session->get('association') === '') {
            $associations = $this->getTAssociations();
            return $this->render('frediAppBundle:association:selectT.html.twig', array(
                'associations' => $associations
            ));
        }

        $association = $em->getRepository('frediAppBundle:Association')->findByUniqueId($associationUniqueId);
        $costs = $em->getRepository('frediAppBundle:CostLine')->findByAssociation($association);

        return $this->render('frediAppBundle:cost:index.html.twig', array(
            'costs' => $costs,
            'associationUniqueId' => $associationUniqueId,
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
    public function showAction(CostLine $costLine, $associationUniqueId)
    {
        $associations = $this->getTAssociations();

        if(!in_array($costLine->getAssociation(), $associations)) {
            throw $this->createNotFoundException("We can't find this association");
        }
        return $this->render('frediAppBundle:cost:show.html.twig', array(
            'costLine' => $costLine,
            'associationUniqueId' => $associationUniqueId,
        ));

    }

    public function editAction(Request $request, CostLine $costLine, $associationUniqueId)
    {
        $associations = $this->getTAssociations();

        if(!in_array($costLine->getAssociation(), $associations)) {
            throw $this->createNotFoundException("We can't find this user");
        }

        $deleteForm = $this->createDeleteForm($costLine, $associationUniqueId);
        $editForm = $this->createForm('fredi\AppBundle\Form\CostLineType', $costLine);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $journey = ($costLine->getDistance() * 0.28);
            $total = $costLine->getToll() + $costLine->getMeal() + $costLine->getAccommodation() +$journey ;

            $costLine->setJourneyCost($journey);
            $costLine->setTotal($total);
            $em->persist($costLine);
            $em->flush();
            return $this->redirectToRoute('cost_edit', array('id' => $costLine->getId(), 'associationUniqueId' => $associationUniqueId));
        }
        return $this->render('frediAppBundle:cost:edit.html.twig', array(
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
            $associations = $this->getTAssociations();
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
            $em->remove($costLine);
            $em->flush();
        }
        return $this->redirectToRoute('cost_index', array('associationUniqueId' => $associationUniqueId));
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
            ->setAction($this->generateUrl('cost_delete', array('id' => $costLine->getId(), 'associationUniqueId' => $associationUniqueId)))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
