<?php

namespace MoteurRechercheBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use MoteurRechercheBundle\Entity\Analyse;
use MoteurRechercheBundle\Form\AnalyseType;

/**
 * Analyse controller.
 *
 */
class AnalyseController extends Controller
{
    /**
     * Lists all Analyse entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $analyses = $em->getRepository('MoteurRechercheBundle:Analyse')->findAll();

        return $this->render('analyse/index.html.twig', array(
            'analyses' => $analyses,
        ));
    }

    /**
     * Creates a new Analyse entity.
     *
     */
    public function newAction(Request $request)
    {
        $analyse = new Analyse();
        $form = $this->createForm('MoteurRechercheBundle\Form\AnalyseType', $analyse);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($analyse);
            $em->flush();

            return $this->redirectToRoute('analyse_show', array('id' => $analyse->getId()));
        }

        return $this->render('analyse/new.html.twig', array(
            'analyse' => $analyse,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Analyse entity.
     *
     */
    public function showAction(Analyse $analyse)
    {
        $deleteForm = $this->createDeleteForm($analyse);

        return $this->render('analyse/show.html.twig', array(
            'analyse' => $analyse,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Analyse entity.
     *
     */
    public function editAction(Request $request, Analyse $analyse)
    {
        $deleteForm = $this->createDeleteForm($analyse);
        $editForm = $this->createForm('MoteurRechercheBundle\Form\AnalyseType', $analyse);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($analyse);
            $em->flush();

            return $this->redirectToRoute('analyse_edit', array('id' => $analyse->getId()));
        }

        return $this->render('analyse/edit.html.twig', array(
            'analyse' => $analyse,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Analyse entity.
     *
     */
    public function deleteAction(Request $request, Analyse $analyse)
    {
        $form = $this->createDeleteForm($analyse);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($analyse);
            $em->flush();
        }

        return $this->redirectToRoute('analyse_index');
    }

    /**
     * Creates a form to delete a Analyse entity.
     *
     * @param Analyse $analyse The Analyse entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Analyse $analyse)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('analyse_delete', array('id' => $analyse->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
