<?php

namespace MoteurRechercheBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use MoteurRechercheBundle\Entity\RenseignementClinique;
use MoteurRechercheBundle\Form\RenseignementCliniqueType;

/**
 * RenseignementClinique controller.
 *
 */
class RenseignementCliniqueController extends Controller
{
    /**
     * Lists all RenseignementClinique entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $renseignementCliniques = $em->getRepository('MoteurRechercheBundle:RenseignementClinique')->findAll();

        return $this->render('renseignementclinique/index.html.twig', array(
            'renseignementCliniques' => $renseignementCliniques,
        ));
    }

    /**
     * Creates a new RenseignementClinique entity.
     *
     */
    public function newAction(Request $request)
    {
        $renseignementClinique = new RenseignementClinique();
        $form = $this->createForm('MoteurRechercheBundle\Form\RenseignementCliniqueType', $renseignementClinique);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($renseignementClinique);
            $em->flush();

            return $this->redirectToRoute('renseignementclinique_show', array('id' => $renseignementClinique->getId()));
        }

        return $this->render('renseignementclinique/new.html.twig', array(
            'renseignementClinique' => $renseignementClinique,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a RenseignementClinique entity.
     *
     */
    public function showAction(RenseignementClinique $renseignementClinique)
    {
        $deleteForm = $this->createDeleteForm($renseignementClinique);

        return $this->render('renseignementclinique/show.html.twig', array(
            'renseignementClinique' => $renseignementClinique,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing RenseignementClinique entity.
     *
     */
    public function editAction(Request $request, RenseignementClinique $renseignementClinique)
    {
        $deleteForm = $this->createDeleteForm($renseignementClinique);
        $editForm = $this->createForm('MoteurRechercheBundle\Form\RenseignementCliniqueType', $renseignementClinique);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($renseignementClinique);
            $em->flush();

            return $this->redirectToRoute('renseignementclinique_edit', array('id' => $renseignementClinique->getId()));
        }

        return $this->render('renseignementclinique/edit.html.twig', array(
            'renseignementClinique' => $renseignementClinique,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a RenseignementClinique entity.
     *
     */
    public function deleteAction(Request $request, RenseignementClinique $renseignementClinique)
    {
        $form = $this->createDeleteForm($renseignementClinique);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($renseignementClinique);
            $em->flush();
        }

        return $this->redirectToRoute('renseignementclinique_index');
    }

    /**
     * Creates a form to delete a RenseignementClinique entity.
     *
     * @param RenseignementClinique $renseignementClinique The RenseignementClinique entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(RenseignementClinique $renseignementClinique)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('renseignementclinique_delete', array('id' => $renseignementClinique->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
