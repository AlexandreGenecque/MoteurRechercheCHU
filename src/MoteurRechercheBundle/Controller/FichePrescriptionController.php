<?php

namespace MoteurRechercheBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use MoteurRechercheBundle\Entity\FichePrescription;
use MoteurRechercheBundle\Form\FichePrescriptionType;

/**
 * FichePrescription controller.
 *
 */
class FichePrescriptionController extends Controller
{
    /**
     * Lists all FichePrescription entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $fichePrescriptions = $em->getRepository('MoteurRechercheBundle:FichePrescription')->findAll();

        return $this->render('ficheprescription/index.html.twig', array(
            'fichePrescriptions' => $fichePrescriptions,
        ));
    }

    /**
     * Creates a new FichePrescription entity.
     *
     */
    public function newAction(Request $request)
    {
        $fichePrescription = new FichePrescription();
        $form = $this->createForm('MoteurRechercheBundle\Form\FichePrescriptionType', $fichePrescription);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($fichePrescription);
            $em->flush();

            return $this->redirectToRoute('ficheprescription_show', array('id' => $fichePrescription->getId()));
        }

        return $this->render('ficheprescription/new.html.twig', array(
            'fichePrescription' => $fichePrescription,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a FichePrescription entity.
     *
     */
    public function showAction(FichePrescription $fichePrescription)
    {
        $deleteForm = $this->createDeleteForm($fichePrescription);

        return $this->render('ficheprescription/show.html.twig', array(
            'fichePrescription' => $fichePrescription,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing FichePrescription entity.
     *
     */
    public function editAction(Request $request, FichePrescription $fichePrescription)
    {
        $deleteForm = $this->createDeleteForm($fichePrescription);
        $editForm = $this->createForm('MoteurRechercheBundle\Form\FichePrescriptionType', $fichePrescription);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($fichePrescription);
            $em->flush();

            return $this->redirectToRoute('ficheprescription_edit', array('id' => $fichePrescription->getId()));
        }

        return $this->render('ficheprescription/edit.html.twig', array(
            'fichePrescription' => $fichePrescription,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a FichePrescription entity.
     *
     */
    public function deleteAction(Request $request, FichePrescription $fichePrescription)
    {
        $form = $this->createDeleteForm($fichePrescription);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($fichePrescription);
            $em->flush();
        }

        return $this->redirectToRoute('ficheprescription_index');
    }

    /**
     * Creates a form to delete a FichePrescription entity.
     *
     * @param FichePrescription $fichePrescription The FichePrescription entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(FichePrescription $fichePrescription)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('ficheprescription_delete', array('id' => $fichePrescription->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
