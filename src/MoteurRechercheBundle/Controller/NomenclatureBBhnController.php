<?php

namespace MoteurRechercheBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use MoteurRechercheBundle\Entity\NomenclatureBBhn;
use MoteurRechercheBundle\Form\NomenclatureBBhnType;

/**
 * NomenclatureBBhn controller.
 *
 */
class NomenclatureBBhnController extends Controller
{
    /**
     * Lists all NomenclatureBBhn entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $nomenclatureBBhns = $em->getRepository('MoteurRechercheBundle:NomenclatureBBhn')->findAll();

        return $this->render('nomenclaturebbhn/index.html.twig', array(
            'nomenclatureBBhns' => $nomenclatureBBhns,
        ));
    }

    /**
     * Creates a new NomenclatureBBhn entity.
     *
     */
    public function newAction(Request $request)
    {
        $nomenclatureBBhn = new NomenclatureBBhn();
        $form = $this->createForm('MoteurRechercheBundle\Form\NomenclatureBBhnType', $nomenclatureBBhn);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($nomenclatureBBhn);
            $em->flush();

            return $this->redirectToRoute('nomenclaturebbhn_show', array('id' => $nomenclatureBBhn->getId()));
        }

        return $this->render('nomenclaturebbhn/new.html.twig', array(
            'nomenclatureBBhn' => $nomenclatureBBhn,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a NomenclatureBBhn entity.
     *
     */
    public function showAction(NomenclatureBBhn $nomenclatureBBhn)
    {
        $deleteForm = $this->createDeleteForm($nomenclatureBBhn);

        return $this->render('nomenclaturebbhn/show.html.twig', array(
            'nomenclatureBBhn' => $nomenclatureBBhn,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing NomenclatureBBhn entity.
     *
     */
    public function editAction(Request $request, NomenclatureBBhn $nomenclatureBBhn)
    {
        $deleteForm = $this->createDeleteForm($nomenclatureBBhn);
        $editForm = $this->createForm('MoteurRechercheBundle\Form\NomenclatureBBhnType', $nomenclatureBBhn);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($nomenclatureBBhn);
            $em->flush();

            return $this->redirectToRoute('nomenclaturebbhn_edit', array('id' => $nomenclatureBBhn->getId()));
        }

        return $this->render('nomenclaturebbhn/edit.html.twig', array(
            'nomenclatureBBhn' => $nomenclatureBBhn,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a NomenclatureBBhn entity.
     *
     */
    public function deleteAction(Request $request, NomenclatureBBhn $nomenclatureBBhn)
    {
        $form = $this->createDeleteForm($nomenclatureBBhn);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($nomenclatureBBhn);
            $em->flush();
        }

        return $this->redirectToRoute('nomenclaturebbhn_index');
    }

    /**
     * Creates a form to delete a NomenclatureBBhn entity.
     *
     * @param NomenclatureBBhn $nomenclatureBBhn The NomenclatureBBhn entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(NomenclatureBBhn $nomenclatureBBhn)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('nomenclaturebbhn_delete', array('id' => $nomenclatureBBhn->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
