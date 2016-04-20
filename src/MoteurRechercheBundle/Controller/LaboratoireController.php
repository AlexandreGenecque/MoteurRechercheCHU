<?php

namespace MoteurRechercheBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use MoteurRechercheBundle\Entity\Laboratoire;
use MoteurRechercheBundle\Form\LaboratoireType;

/**
 * Laboratoire controller.
 *
 */
class LaboratoireController extends Controller
{
    /**
     * Lists all Laboratoire entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $laboratoires = $em->getRepository('MoteurRechercheBundle:Laboratoire')->findAll();

        return $this->render('laboratoire/index.html.twig', array(
            'laboratoires' => $laboratoires,
        ));
    }

    /**
     * Creates a new Laboratoire entity.
     *
     */
    public function newAction(Request $request)
    {
        $laboratoire = new Laboratoire();
        $form = $this->createForm('MoteurRechercheBundle\Form\LaboratoireType', $laboratoire);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($laboratoire);
            $em->flush();

            return $this->redirectToRoute('laboratoire_show', array('id' => $laboratoire->getId()));
        }

        return $this->render('laboratoire/new.html.twig', array(
            'laboratoire' => $laboratoire,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Laboratoire entity.
     *
     */
    public function showAction(Laboratoire $laboratoire)
    {
        $deleteForm = $this->createDeleteForm($laboratoire);

        return $this->render('laboratoire/show.html.twig', array(
            'laboratoire' => $laboratoire,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Laboratoire entity.
     *
     */
    public function editAction(Request $request, Laboratoire $laboratoire)
    {
        $deleteForm = $this->createDeleteForm($laboratoire);
        $editForm = $this->createForm('MoteurRechercheBundle\Form\LaboratoireType', $laboratoire);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($laboratoire);
            $em->flush();

            return $this->redirectToRoute('laboratoire_edit', array('id' => $laboratoire->getId()));
        }

        return $this->render('laboratoire/edit.html.twig', array(
            'laboratoire' => $laboratoire,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Laboratoire entity.
     *
     */
    public function deleteAction(Request $request, Laboratoire $laboratoire)
    {
        $form = $this->createDeleteForm($laboratoire);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($laboratoire);
            $em->flush();
        }

        return $this->redirectToRoute('laboratoire_index');
    }

    /**
     * Creates a form to delete a Laboratoire entity.
     *
     * @param Laboratoire $laboratoire The Laboratoire entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Laboratoire $laboratoire)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('laboratoire_delete', array('id' => $laboratoire->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
