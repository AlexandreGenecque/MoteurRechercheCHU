<?php

namespace MoteurRechercheBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use MoteurRechercheBundle\Entity\DelaiResultat;
use MoteurRechercheBundle\Form\DelaiResultatType;

/**
 * DelaiResultat controller.
 *
 */
class DelaiResultatController extends Controller
{
    /**
     * Lists all DelaiResultat entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $delaiResultats = $em->getRepository('MoteurRechercheBundle:DelaiResultat')->findAll();

        return $this->render('delairesultat/index.html.twig', array(
            'delaiResultats' => $delaiResultats,
        ));
    }

    /**
     * Creates a new DelaiResultat entity.
     *
     */
    public function newAction(Request $request)
    {
        $delaiResultat = new DelaiResultat();
        $form = $this->createForm('MoteurRechercheBundle\Form\DelaiResultatType', $delaiResultat);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($delaiResultat);
            $em->flush();

            return $this->redirectToRoute('delairesultat_show', array('id' => $delaiResultat->getId()));
        }

        return $this->render('delairesultat/new.html.twig', array(
            'delaiResultat' => $delaiResultat,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a DelaiResultat entity.
     *
     */
    public function showAction(DelaiResultat $delaiResultat)
    {
        $deleteForm = $this->createDeleteForm($delaiResultat);

        return $this->render('delairesultat/show.html.twig', array(
            'delaiResultat' => $delaiResultat,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing DelaiResultat entity.
     *
     */
    public function editAction(Request $request, DelaiResultat $delaiResultat)
    {
        $deleteForm = $this->createDeleteForm($delaiResultat);
        $editForm = $this->createForm('MoteurRechercheBundle\Form\DelaiResultatType', $delaiResultat);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($delaiResultat);
            $em->flush();

            return $this->redirectToRoute('delairesultat_edit', array('id' => $delaiResultat->getId()));
        }

        return $this->render('delairesultat/edit.html.twig', array(
            'delaiResultat' => $delaiResultat,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a DelaiResultat entity.
     *
     */
    public function deleteAction(Request $request, DelaiResultat $delaiResultat)
    {
        $form = $this->createDeleteForm($delaiResultat);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($delaiResultat);
            $em->flush();
        }

        return $this->redirectToRoute('delairesultat_index');
    }

    /**
     * Creates a form to delete a DelaiResultat entity.
     *
     * @param DelaiResultat $delaiResultat The DelaiResultat entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(DelaiResultat $delaiResultat)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('delairesultat_delete', array('id' => $delaiResultat->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
