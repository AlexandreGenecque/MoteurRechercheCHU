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


use Symfony\Component\HttpFoundation\Response;

/**
 * Analyse controller.
 *
 */
class RechercheIndexController extends Controller
{

    public function indexAction()
    {

         $laboratoire = new Laboratoire();

        $em = $this->getDoctrine()->getManager()->getRepository('MoteurRechercheBundle:Laboratoire');
        $rechercheLaboratoire = $em->findAll();


        $microOrganisme = new MicroOrganisme();

        $em = $this->getDoctrine()->getManager()->getRepository('MoteurRechercheBundle:MicroOrganisme');
        $rechercheMicroOrganisme = $em->findAll();

        return $this->render('rechercheIndex/index.html.twig', array('rechercheLaboratoire' => $rechercheLaboratoire, 'rechercheMicroOrganisme' => $rechercheMicroOrganisme)); 
    }

   /* public function rechercheAction(Request $request)
    {
        $recherche = new Analyse();

        $saisie = $request->get('recherche');

        if ($saisie != "" && ! ctype_space($saisie))
        {
            $em = $this->getDoctrine()->getManager()->getRepository('MoteurRechercheBundle:Analyse');
            $resultat = $em->rechercheAnalyse($saisie);

            if(! $resultat)
            {
                return new Response('<html><body>Pas de résultat pour votre recherche</body></html>');
            }

            return $this->render('rechercheIndex/liste.html.twig', array('resultat' => $resultat));
        }
        
        return $this->render('rechercheIndex/index.html.twig');
    } */

    public function rechercheAjaxAction(Request $request)
    {
        if($request->isXmlHttpRequest())
        {
            $recherche = new Analyse();

            $saisie= $request->get('zoneLibre');
            $choixLabo = $request->get('choixLabo');
            $choixMicroOrg = $request->get('choixMicroOrg');

            if ($saisie != "" && ! ctype_space($saisie))
            {
                $em = $this->getDoctrine()->getManager()->getRepository('MoteurRechercheBundle:Analyse');
                $resultat = $em->rechercheAnalyse($saisie, $choixLabo, $choixMicroOrg);

                if(! $resultat)
                {
                    return new Response('<html><body>Pas de résultat pour votre recherche</body></html>');
                }

                return $this->render('rechercheIndex/liste.html.twig', array('resultat' => $resultat));
            }
        }
        
        return $this->render('rechercheIndex/index.html.twig');
    }

    public function ouvrirAnalyseSimpleAction($id)
    {
        $em = $this->getDoctrine()->getManager()->getRepository('MoteurRechercheBundle:Analyse');
        $analyse = $em->find($id);

        if(! $analyse){
            throw $this->createNotFoundException("Erreur : impossible de trouver l'analyse");
        }

        return $this->render('rechercheIndex/analyse_simple.html.twig', array('analyse' => $analyse));

    }
}

