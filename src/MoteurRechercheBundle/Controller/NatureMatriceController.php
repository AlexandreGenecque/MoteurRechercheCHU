<?php

namespace MoteurRechercheBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use MoteurRechercheBundle\Entity\NatureMatrice;
use MoteurRechercheBundle\Form\NatureMatriceType;

/**
 * NatureMatrice controller.
 *
 */
class NatureMatriceController extends Controller
{
    /**
     * Lists all NatureMatrice entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $natureMatrices = $em->getRepository('MoteurRechercheBundle:NatureMatrice')->findAll();

        return $this->render('naturematrice/index.html.twig', array(
            'natureMatrices' => $natureMatrices,
        ));
    }

    /**
     * Creates a new NatureMatrice entity.
     *
     */
    public function newAction(Request $request)
    {
        $natureMatrice = new NatureMatrice();
        $form = $this->createForm('MoteurRechercheBundle\Form\NatureMatriceType', $natureMatrice);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($natureMatrice);
            $em->flush();

            return $this->redirectToRoute('naturematrice_show', array('id' => $natureMatrice->getId()));
        }

        return $this->render('naturematrice/new.html.twig', array(
            'natureMatrice' => $natureMatrice,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a NatureMatrice entity.
     *
     */
    public function showAction(NatureMatrice $natureMatrice)
    {
        $deleteForm = $this->createDeleteForm($natureMatrice);

        return $this->render('naturematrice/show.html.twig', array(
            'natureMatrice' => $natureMatrice,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing NatureMatrice entity.
     *
     */
    public function editAction(Request $request, NatureMatrice $natureMatrice)
    {
        $deleteForm = $this->createDeleteForm($natureMatrice);
        $editForm = $this->createForm('MoteurRechercheBundle\Form\NatureMatriceType', $natureMatrice);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($natureMatrice);
            $em->flush();

            return $this->redirectToRoute('naturematrice_edit', array('id' => $natureMatrice->getId()));
        }

        return $this->render('naturematrice/edit.html.twig', array(
            'natureMatrice' => $natureMatrice,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a NatureMatrice entity.
     *
     */
    public function deleteAction(Request $request, NatureMatrice $natureMatrice)
    {
        $form = $this->createDeleteForm($natureMatrice);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($natureMatrice);
            $em->flush();
        }

        return $this->redirectToRoute('naturematrice_index');
    }

    /**
     * Creates a form to delete a NatureMatrice entity.
     *
     * @param NatureMatrice $natureMatrice The NatureMatrice entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(NatureMatrice $natureMatrice)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('naturematrice_delete', array('id' => $natureMatrice->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
