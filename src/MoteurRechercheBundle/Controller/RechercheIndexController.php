<?php

namespace MoteurRechercheBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use MoteurRechercheBundle\Entity\Analyse;
use MoteurRechercheBundle\Entity\ConditionPrelevement;
use MoteurRechercheBundle\Entity\ConservationAvantTransport;
use MoteurRechercheBundle\Entity\DelaiResultat;
use MoteurRechercheBundle\Entity\FichePrescription;
use MoteurRechercheBundle\Entity\Laboratoire;
use MoteurRechercheBundle\Entity\MicroOrganisme;
use MoteurRechercheBundle\Entity\NatureMatrice;
use MoteurRechercheBundle\Entity\NaturePrelevement;
use MoteurRechercheBundle\Entity\PrincipeMethode;
use MoteurRechercheBundle\Entity\RenseignementClinique;
use MoteurRechercheBundle\Entity\Secteur;
use MoteurRechercheBundle\Entity\Transport;



/**
 * Analyse controller.
 *
 */
class RechercheIndexController extends Controller
{

    public function indexAction()
    {
        return $this->render('rechercheIndex/index.html.twig');
    }

    public function rechercheAction(Request $request)
    {
        $recherche = new Analyse();

        //$form = $this->createFormeBuilder($recherche);

        $form = handleRequest($request);

        if($form->isValid())
        {
            $em = $this->getDoctrine()->getManager()->getRepository('MoteurRechercheBundle:Analyse');

            // ajouter le param
            $resultat = $em->rechercheAnalyse();

            if(! $resultat){
                return new Response('<html><body>Pas de résultat pour votre recherche</body></html>');
            }
             return $this->render('MoteurRechercheBundle:RechercheIndex:liste.html.twig', array('entities' => $resultat));
        }
            
        return $this->render('MoteurRechercheBundle:Analyse:form_recherche.html.twig', array(
            'form' => $form->createView(),
        ));
        
        }
    public function ouvrirAnalyseSimpleAction($id)
    {
        $em = $this->getDoctrine()->getManager()->getRepository('MoteurRechercheBundle:Analyse');
        $analyse = $em->find($id);

        if(! $analyse){
            throw $this->createNotFoundException("Erreur : impossible de trouver l'analyse");
        }

        return $this->render('MoteurRechercheBundle:rechercheIndex:analyse_simple.html.twig', $analyse);

    }

}





