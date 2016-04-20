<?php

namespace MoteurRechercheBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use MoteurRechercheBundle\Entity\ConservationAvantTransport;
use MoteurRechercheBundle\Form\ConservationAvantTransportType;

/**
 * ConservationAvantTransport controller.
 *
 */
class ConservationAvantTransportController extends Controller
{
    /**
     * Lists all ConservationAvantTransport entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $conservationAvantTransports = $em->getRepository('MoteurRechercheBundle:ConservationAvantTransport')->findAll();

        return $this->render('conservationavanttransport/index.html.twig', array(
            'conservationAvantTransports' => $conservationAvantTransports,
        ));
    }

    /**
     * Creates a new ConservationAvantTransport entity.
     *
     */
    public function newAction(Request $request)
    {
        $conservationAvantTransport = new ConservationAvantTransport();
        $form = $this->createForm('MoteurRechercheBundle\Form\ConservationAvantTransportType', $conservationAvantTransport);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($conservationAvantTransport);
            $em->flush();

            return $this->redirectToRoute('conservationavanttransport_show', array('id' => $conservationAvantTransport->getId()));
        }

        return $this->render('conservationavanttransport/new.html.twig', array(
            'conservationAvantTransport' => $conservationAvantTransport,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a ConservationAvantTransport entity.
     *
     */
    public function showAction(ConservationAvantTransport $conservationAvantTransport)
    {
        $deleteForm = $this->createDeleteForm($conservationAvantTransport);

        return $this->render('conservationavanttransport/show.html.twig', array(
            'conservationAvantTransport' => $conservationAvantTransport,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing ConservationAvantTransport entity.
     *
     */
    public function editAction(Request $request, ConservationAvantTransport $conservationAvantTransport)
    {
        $deleteForm = $this->createDeleteForm($conservationAvantTransport);
        $editForm = $this->createForm('MoteurRechercheBundle\Form\ConservationAvantTransportType', $conservationAvantTransport);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($conservationAvantTransport);
            $em->flush();

            return $this->redirectToRoute('conservationavanttransport_edit', array('id' => $conservationAvantTransport->getId()));
        }

        return $this->render('conservationavanttransport/edit.html.twig', array(
            'conservationAvantTransport' => $conservationAvantTransport,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a ConservationAvantTransport entity.
     *
     */
    public function deleteAction(Request $request, ConservationAvantTransport $conservationAvantTransport)
    {
        $form = $this->createDeleteForm($conservationAvantTransport);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($conservationAvantTransport);
            $em->flush();
        }

        return $this->redirectToRoute('conservationavanttransport_index');
    }

    /**
     * Creates a form to delete a ConservationAvantTransport entity.
     *
     * @param ConservationAvantTransport $conservationAvantTransport The ConservationAvantTransport entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(ConservationAvantTransport $conservationAvantTransport)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('conservationavanttransport_delete', array('id' => $conservationAvantTransport->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
