<?php

namespace MoteurRechercheBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use MoteurRechercheBundle\Entity\NaturePrelevement;
use MoteurRechercheBundle\Form\NaturePrelevementType;

/**
 * NaturePrelevement controller.
 *
 */
class NaturePrelevementController extends Controller
{
    /**
     * Lists all NaturePrelevement entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $naturePrelevements = $em->getRepository('MoteurRechercheBundle:NaturePrelevement')->findAll();

        return $this->render('natureprelevement/index.html.twig', array(
            'naturePrelevements' => $naturePrelevements,
        ));
    }

    /**
     * Creates a new NaturePrelevement entity.
     *
     */
    public function newAction(Request $request)
    {
        $naturePrelevement = new NaturePrelevement();
        $form = $this->createForm('MoteurRechercheBundle\Form\NaturePrelevementType', $naturePrelevement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($naturePrelevement);
            $em->flush();

            return $this->redirectToRoute('natureprelevement_show', array('id' => $naturePrelevement->getId()));
        }

        return $this->render('natureprelevement/new.html.twig', array(
            'naturePrelevement' => $naturePrelevement,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a NaturePrelevement entity.
     *
     */
    public function showAction(NaturePrelevement $naturePrelevement)
    {
        $deleteForm = $this->createDeleteForm($naturePrelevement);

        return $this->render('natureprelevement/show.html.twig', array(
            'naturePrelevement' => $naturePrelevement,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing NaturePrelevement entity.
     *
     */
    public function editAction(Request $request, NaturePrelevement $naturePrelevement)
    {
        $deleteForm = $this->createDeleteForm($naturePrelevement);
        $editForm = $this->createForm('MoteurRechercheBundle\Form\NaturePrelevementType', $naturePrelevement);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($naturePrelevement);
            $em->flush();

            return $this->redirectToRoute('natureprelevement_edit', array('id' => $naturePrelevement->getId()));
        }

        return $this->render('natureprelevement/edit.html.twig', array(
            'naturePrelevement' => $naturePrelevement,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a NaturePrelevement entity.
     *
     */
    public function deleteAction(Request $request, NaturePrelevement $naturePrelevement)
    {
        $form = $this->createDeleteForm($naturePrelevement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($naturePrelevement);
            $em->flush();
        }

        return $this->redirectToRoute('natureprelevement_index');
    }

    /**
     * Creates a form to delete a NaturePrelevement entity.
     *
     * @param NaturePrelevement $naturePrelevement The NaturePrelevement entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(NaturePrelevement $naturePrelevement)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('natureprelevement_delete', array('id' => $naturePrelevement->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
