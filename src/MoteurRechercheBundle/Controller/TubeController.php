<?php

namespace MoteurRechercheBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use MoteurRechercheBundle\Entity\Tube;
use MoteurRechercheBundle\Form\TubeType;

/**
 * Tube controller.
 *
 */
class TubeController extends Controller
{
    /**
     * Lists all Tube entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $tubes = $em->getRepository('MoteurRechercheBundle:Tube')->findAll();

        return $this->render('tube/index.html.twig', array(
            'tubes' => $tubes,
        ));
    }

    /**
     * Creates a new Tube entity.
     *
     */
    public function newAction(Request $request)
    {
        $tube = new Tube();
        $form = $this->createForm('MoteurRechercheBundle\Form\TubeType', $tube);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($tube);
            $em->flush();

            return $this->redirectToRoute('tube_show', array('id' => $tube->getId()));
        }

        return $this->render('tube/new.html.twig', array(
            'tube' => $tube,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Tube entity.
     *
     */
    public function showAction(Tube $tube)
    {
        $deleteForm = $this->createDeleteForm($tube);

        return $this->render('tube/show.html.twig', array(
            'tube' => $tube,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Tube entity.
     *
     */
    public function editAction(Request $request, Tube $tube)
    {
        $deleteForm = $this->createDeleteForm($tube);
        $editForm = $this->createForm('MoteurRechercheBundle\Form\TubeType', $tube);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($tube);
            $em->flush();

            return $this->redirectToRoute('tube_edit', array('id' => $tube->getId()));
        }

        return $this->render('tube/edit.html.twig', array(
            'tube' => $tube,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Tube entity.
     *
     */
    public function deleteAction(Request $request, Tube $tube)
    {
        $form = $this->createDeleteForm($tube);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($tube);
            $em->flush();
        }

        return $this->redirectToRoute('tube_index');
    }

    /**
     * Creates a form to delete a Tube entity.
     *
     * @param Tube $tube The Tube entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Tube $tube)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('tube_delete', array('id' => $tube->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
