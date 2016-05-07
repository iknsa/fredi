<?php

namespace fredi\AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use fredi\AppBundle\Entity\Association;
use fredi\AppBundle\Form\AssociationType;
use fredi\AppBundle\Traits\GetAssociationsTrait;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Process\Exception\LogicException;


/**
 * Association controller.
 *
 */
class AssociationController extends Controller
{
    use GetAssociationsTrait;

    /**
     * Lists all Association entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $associations = $this->getAssociations();

        return $this->render('frediAppBundle:association:index.html.twig', array(
            'associations' => $associations,
        ));
    }

    /**
     * Creates a new Association entity.
     *
     */
    public function newAction(Request $request)
    {
        $association = new Association();
        $form = $this->createForm('fredi\AppBundle\Form\AssociationType', $association);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($association);
            $em->flush();

            return $this->redirectToRoute('association_show', array('id' => $association->getId()));
        }

        return $this->render('association/new.html.twig', array(
            'association' => $association,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Association entity.
     *
     */
    public function showAction(Association $association)
    {
        $deleteForm = $this->createDeleteForm($association);

        return $this->render('association/show.html.twig', array(
            'association' => $association,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Association entity.
     *
     */
    public function editAction(Request $request, Association $association)
    {
        $deleteForm = $this->createDeleteForm($association);
        $editForm = $this->createForm('fredi\AppBundle\Form\AssociationType', $association);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($association);
            $em->flush();

            return $this->redirectToRoute('association_edit', array('id' => $association->getId()));
        }

        return $this->render('association/edit.html.twig', array(
            'association' => $association,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Association entity.
     *
     */
    public function deleteAction(Request $request, Association $association)
    {
        $form = $this->createDeleteForm($association);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($association);
            $em->flush();
        }

        return $this->redirectToRoute('association_index');
    }

    /**
     * Creates a form to delete a Association entity.
     *
     * @param Association $association The Association entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Association $association)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('association_delete', array('id' => $association->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }

    public function selectAction(Request $request, $associationUniqueId, $id=null)
    {
        $session = new Session;

        $session->set('association', '');

        $association = $this->getAssociations();

        foreach ($association as $key => $value) {
            if($value->getUniqueId() === $associationUniqueId) {
                $session->set('association', $value);
            }
        }
        if($session->get('association') === '') {
            throw new LogicException("We were unable to load your association. Make sure you have the proper rights or contact your admin");
        }
        return $this->redirect($this->generateUrl($session->get('last_route')['name'], array('id' => $id, 'associationUniqueId' => $associationUniqueId)) );
    }

    public function unsetAssociationFromSessionAction()
    {
        $session = new Session;
        $session->set('association', null);
        return $this->redirect($this->generateUrl('fredi_app_homepage'));
    }
}
