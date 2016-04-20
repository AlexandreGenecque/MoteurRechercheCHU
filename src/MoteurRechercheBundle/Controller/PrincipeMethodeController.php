<?php

namespace MoteurRechercheBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use MoteurRechercheBundle\Entity\PrincipeMethode;
use MoteurRechercheBundle\Form\PrincipeMethodeType;

/**
 * PrincipeMethode controller.
 *
 */
class PrincipeMethodeController extends Controller
{
    /**
     * Lists all PrincipeMethode entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $principeMethodes = $em->getRepository('MoteurRechercheBundle:PrincipeMethode')->findAll();

        return $this->render('principemethode/index.html.twig', array(
            'principeMethodes' => $principeMethodes,
        ));
    }

    /**
     * Creates a new PrincipeMethode entity.
     *
     */
    public function newAction(Request $request)
    {
        $principeMethode = new PrincipeMethode();
        $form = $this->createForm('MoteurRechercheBundle\Form\PrincipeMethodeType', $principeMethode);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($principeMethode);
            $em->flush();

            return $this->redirectToRoute('principemethode_show', array('id' => $principeMethode->getId()));
        }

        return $this->render('principemethode/new.html.twig', array(
            'principeMethode' => $principeMethode,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a PrincipeMethode entity.
     *
     */
    public function showAction(PrincipeMethode $principeMethode)
    {
        $deleteForm = $this->createDeleteForm($principeMethode);

        return $this->render('principemethode/show.html.twig', array(
            'principeMethode' => $principeMethode,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing PrincipeMethode entity.
     *
     */
    public function editAction(Request $request, PrincipeMethode $principeMethode)
    {
        $deleteForm = $this->createDeleteForm($principeMethode);
        $editForm = $this->createForm('MoteurRechercheBundle\Form\PrincipeMethodeType', $principeMethode);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($principeMethode);
            $em->flush();

            return $this->redirectToRoute('principemethode_edit', array('id' => $principeMethode->getId()));
        }

        return $this->render('principemethode/edit.html.twig', array(
            'principeMethode' => $principeMethode,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a PrincipeMethode entity.
     *
     */
    public function deleteAction(Request $request, PrincipeMethode $principeMethode)
    {
        $form = $this->createDeleteForm($principeMethode);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($principeMethode);
            $em->flush();
        }

        return $this->redirectToRoute('principemethode_index');
    }

    /**
     * Creates a form to delete a PrincipeMethode entity.
     *
     * @param PrincipeMethode $principeMethode The PrincipeMethode entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(PrincipeMethode $principeMethode)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('principemethode_delete', array('id' => $principeMethode->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
