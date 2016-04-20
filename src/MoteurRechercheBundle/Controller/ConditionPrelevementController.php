<?php

namespace MoteurRechercheBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use MoteurRechercheBundle\Entity\ConditionPrelevement;
use MoteurRechercheBundle\Form\ConditionPrelevementType;

/**
 * ConditionPrelevement controller.
 *
 */
class ConditionPrelevementController extends Controller
{
    /**
     * Lists all ConditionPrelevement entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $conditionPrelevements = $em->getRepository('MoteurRechercheBundle:ConditionPrelevement')->findAll();

        return $this->render('conditionprelevement/index.html.twig', array(
            'conditionPrelevements' => $conditionPrelevements,
        ));
    }

    /**
     * Creates a new ConditionPrelevement entity.
     *
     */
    public function newAction(Request $request)
    {
        $conditionPrelevement = new ConditionPrelevement();
        $form = $this->createForm('MoteurRechercheBundle\Form\ConditionPrelevementType', $conditionPrelevement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($conditionPrelevement);
            $em->flush();

            return $this->redirectToRoute('conditionprelevement_show', array('id' => $conditionPrelevement->getId()));
        }

        return $this->render('conditionprelevement/new.html.twig', array(
            'conditionPrelevement' => $conditionPrelevement,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a ConditionPrelevement entity.
     *
     */
    public function showAction(ConditionPrelevement $conditionPrelevement)
    {
        $deleteForm = $this->createDeleteForm($conditionPrelevement);

        return $this->render('conditionprelevement/show.html.twig', array(
            'conditionPrelevement' => $conditionPrelevement,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing ConditionPrelevement entity.
     *
     */
    public function editAction(Request $request, ConditionPrelevement $conditionPrelevement)
    {
        $deleteForm = $this->createDeleteForm($conditionPrelevement);
        $editForm = $this->createForm('MoteurRechercheBundle\Form\ConditionPrelevementType', $conditionPrelevement);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($conditionPrelevement);
            $em->flush();

            return $this->redirectToRoute('conditionprelevement_edit', array('id' => $conditionPrelevement->getId()));
        }

        return $this->render('conditionprelevement/edit.html.twig', array(
            'conditionPrelevement' => $conditionPrelevement,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a ConditionPrelevement entity.
     *
     */
    public function deleteAction(Request $request, ConditionPrelevement $conditionPrelevement)
    {
        $form = $this->createDeleteForm($conditionPrelevement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($conditionPrelevement);
            $em->flush();
        }

        return $this->redirectToRoute('conditionprelevement_index');
    }

    /**
     * Creates a form to delete a ConditionPrelevement entity.
     *
     * @param ConditionPrelevement $conditionPrelevement The ConditionPrelevement entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(ConditionPrelevement $conditionPrelevement)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('conditionprelevement_delete', array('id' => $conditionPrelevement->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
