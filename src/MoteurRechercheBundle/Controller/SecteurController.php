<?php

namespace MoteurRechercheBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use MoteurRechercheBundle\Entity\Secteur;
use MoteurRechercheBundle\Form\SecteurType;

/**
 * Secteur controller.
 *
 */
class SecteurController extends Controller
{
    /**
     * Lists all Secteur entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $secteurs = $em->getRepository('MoteurRechercheBundle:Secteur')->findAll();

        return $this->render('secteur/index.html.twig', array(
            'secteurs' => $secteurs,
        ));
    }

    /**
     * Creates a new Secteur entity.
     *
     */
    public function newAction(Request $request)
    {
        $secteur = new Secteur();
        $form = $this->createForm('MoteurRechercheBundle\Form\SecteurType', $secteur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($secteur);
            $em->flush();

            return $this->redirectToRoute('secteur_show', array('id' => $secteur->getId()));
        }

        return $this->render('secteur/new.html.twig', array(
            'secteur' => $secteur,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Secteur entity.
     *
     */
    public function showAction(Secteur $secteur)
    {
        $deleteForm = $this->createDeleteForm($secteur);

        return $this->render('secteur/show.html.twig', array(
            'secteur' => $secteur,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Secteur entity.
     *
     */
    public function editAction(Request $request, Secteur $secteur)
    {
        $deleteForm = $this->createDeleteForm($secteur);
        $editForm = $this->createForm('MoteurRechercheBundle\Form\SecteurType', $secteur);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($secteur);
            $em->flush();

            return $this->redirectToRoute('secteur_edit', array('id' => $secteur->getId()));
        }

        return $this->render('secteur/edit.html.twig', array(
            'secteur' => $secteur,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Secteur entity.
     *
     */
    public function deleteAction(Request $request, Secteur $secteur)
    {
        $form = $this->createDeleteForm($secteur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($secteur);
            $em->flush();
        }

        return $this->redirectToRoute('secteur_index');
    }

    /**
     * Creates a form to delete a Secteur entity.
     *
     * @param Secteur $secteur The Secteur entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Secteur $secteur)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('secteur_delete', array('id' => $secteur->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
