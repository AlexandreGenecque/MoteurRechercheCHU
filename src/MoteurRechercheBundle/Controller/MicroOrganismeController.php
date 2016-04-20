<?php

namespace MoteurRechercheBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use MoteurRechercheBundle\Entity\MicroOrganisme;
use MoteurRechercheBundle\Form\MicroOrganismeType;

/**
 * MicroOrganisme controller.
 *
 */
class MicroOrganismeController extends Controller
{
    /**
     * Lists all MicroOrganisme entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $microOrganismes = $em->getRepository('MoteurRechercheBundle:MicroOrganisme')->findAll();

        return $this->render('microorganisme/index.html.twig', array(
            'microOrganismes' => $microOrganismes,
        ));
    }

    /**
     * Creates a new MicroOrganisme entity.
     *
     */
    public function newAction(Request $request)
    {
        $microOrganisme = new MicroOrganisme();
        $form = $this->createForm('MoteurRechercheBundle\Form\MicroOrganismeType', $microOrganisme);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($microOrganisme);
            $em->flush();

            return $this->redirectToRoute('microorganisme_show', array('id' => $microOrganisme->getId()));
        }

        return $this->render('microorganisme/new.html.twig', array(
            'microOrganisme' => $microOrganisme,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a MicroOrganisme entity.
     *
     */
    public function showAction(MicroOrganisme $microOrganisme)
    {
        $deleteForm = $this->createDeleteForm($microOrganisme);

        return $this->render('microorganisme/show.html.twig', array(
            'microOrganisme' => $microOrganisme,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing MicroOrganisme entity.
     *
     */
    public function editAction(Request $request, MicroOrganisme $microOrganisme)
    {
        $deleteForm = $this->createDeleteForm($microOrganisme);
        $editForm = $this->createForm('MoteurRechercheBundle\Form\MicroOrganismeType', $microOrganisme);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($microOrganisme);
            $em->flush();

            return $this->redirectToRoute('microorganisme_edit', array('id' => $microOrganisme->getId()));
        }

        return $this->render('microorganisme/edit.html.twig', array(
            'microOrganisme' => $microOrganisme,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a MicroOrganisme entity.
     *
     */
    public function deleteAction(Request $request, MicroOrganisme $microOrganisme)
    {
        $form = $this->createDeleteForm($microOrganisme);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($microOrganisme);
            $em->flush();
        }

        return $this->redirectToRoute('microorganisme_index');
    }

    /**
     * Creates a form to delete a MicroOrganisme entity.
     *
     * @param MicroOrganisme $microOrganisme The MicroOrganisme entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(MicroOrganisme $microOrganisme)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('microorganisme_delete', array('id' => $microOrganisme->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
