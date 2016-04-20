<?php

namespace MoteurRechercheBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use MoteurRechercheBundle\Entity\Transport;
use MoteurRechercheBundle\Form\TransportType;

/**
 * Transport controller.
 *
 */
class TransportController extends Controller
{
    /**
     * Lists all Transport entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $transports = $em->getRepository('MoteurRechercheBundle:Transport')->findAll();

        return $this->render('transport/index.html.twig', array(
            'transports' => $transports,
        ));
    }

    /**
     * Creates a new Transport entity.
     *
     */
    public function newAction(Request $request)
    {
        $transport = new Transport();
        $form = $this->createForm('MoteurRechercheBundle\Form\TransportType', $transport);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($transport);
            $em->flush();

            return $this->redirectToRoute('transport_show', array('id' => $transport->getId()));
        }

        return $this->render('transport/new.html.twig', array(
            'transport' => $transport,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Transport entity.
     *
     */
    public function showAction(Transport $transport)
    {
        $deleteForm = $this->createDeleteForm($transport);

        return $this->render('transport/show.html.twig', array(
            'transport' => $transport,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Transport entity.
     *
     */
    public function editAction(Request $request, Transport $transport)
    {
        $deleteForm = $this->createDeleteForm($transport);
        $editForm = $this->createForm('MoteurRechercheBundle\Form\TransportType', $transport);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($transport);
            $em->flush();

            return $this->redirectToRoute('transport_edit', array('id' => $transport->getId()));
        }

        return $this->render('transport/edit.html.twig', array(
            'transport' => $transport,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Transport entity.
     *
     */
    public function deleteAction(Request $request, Transport $transport)
    {
        $form = $this->createDeleteForm($transport);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($transport);
            $em->flush();
        }

        return $this->redirectToRoute('transport_index');
    }

    /**
     * Creates a form to delete a Transport entity.
     *
     * @param Transport $transport The Transport entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Transport $transport)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('transport_delete', array('id' => $transport->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
