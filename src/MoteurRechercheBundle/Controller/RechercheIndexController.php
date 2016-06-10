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

        //return $this->render('rechercheIndex/index.html.twig');
    }


    public function rechercheAjaxAction(Request $request)
    {
        if($request->isXmlHttpRequest())
        {
            $recherche = new Analyse();

            $saisie = $request->get('zonelibre');
            $saisieLabo = $request->get('selectLabo');
            $saisieMicroOrg = $request->get('selectMicroOrg');
            $em = $this->getDoctrine()->getManager()->getRepository('MoteurRechercheBundle:Analyse');
            $em2 = $this->getDoctrine()->getManager()->getRepository('MoteurRechercheBundle:Laboratoire');
            $em3 = $this->getDoctrine()->getManager()->getRepository('MoteurRechercheBundle:MicroOrganisme');

//            return new Response('Saisie = '.$saisie.' / Labo:'.$saisieLabo.' / MicroOrganisme:'. $saisieMicroOrg. '');

            if($saisie != "" && ! ctype_space($saisie) && $saisieLabo == "defaut" && $saisieMicroOrg == "defaut")
            {
                 $resultat = $em->rechercheAnalyse($saisie);
            }
            else if ($saisie != "" && ! ctype_space($saisie) && $saisieLabo != "defaut" && $saisieMicroOrg == "defaut") {
                $labo = $em2->findBynomLaboratoire($saisieLabo);
                $resultat = $em->rechercheAnalyseAvecLabo($saisie,$labo);
            }
            else if ($saisie != "" && ! ctype_space($saisie) && $saisieLabo == "defaut" && $saisieMicroOrg != "defaut") {
                # code...
                $resultat = $em->rechercheAnalyse($saisie, $saisieMicroOrg );
            }
            else if ($saisie != "" && ! ctype_space($saisie) && $saisieLabo != "defaut" && $saisieMicroOrg != "defaut") {
                # code...
                $resultat = $em->rechercheAnalyse($saisie, $saisieLabo, $saisieMicroOrg);
            }
            elseif ($saisie == "" &&  ctype_space($saisie) && $saisieLabo != "defaut" && $saisieMicroOrg != "defaut") {
                # code...
                $resultat = $em->rechercheAnalyse($saisieLabo, $saisieMicroOrg);
            }
            else if ($saisie == "" &&  ctype_space($saisie) && $saisieLabo != "defaut" && $saisieMicroOrg == "defaut") {
                # code...
                $resultat = $em->rechercheAnalyse($saisieLabo);
            }
            else if ($saisie == "" &&  ctype_space($saisie) && $saisieLabo == "defaut" && $saisieMicroOrg != "defaut") {
                # code...
                $resultat = $em->rechercheAnalyse($saisieMicroOrg);
            }
            

            if(! $resultat)
                {
                    return new Response('<html><body>Pas de résultat pour votre recherche </body></html>');
                }
            else
                return $this->render('rechercheIndex/liste.html.twig', array('resultat' => $resultat));
        }

        return $this->render('rechercheIndex/index.html.twig');

               // return new Response('Pas dans la fonction Saisie = '.$saisie.' / Labo:'.$saisieLabo.' / MicroOrganisme:'. $saisieMicroOrg. '');
        /*    if ($saisie != "" && ! ctype_space($saisie))
            {
                $em = $this->getDoctrine()->getManager()->getRepository('MoteurRechercheBundle:Analyse');
                $resultat = $em->rechercheAnalyse($saisie);

                if(! $resultat)
                {
                    return new Response('<html><body>Pas de résultat pour votre recherche </body></html>');
                }

                return $this->render('rechercheIndex/liste.html.twig', array('resultat' => $resultat));
            }
        }
        
        return $this->render('rechercheIndex/index.html.twig');*/
    
    }


    public function rechercheButtonAjaxAction(Request $request)
    {
      //  $saisie = $request->get('lettre');
    // return new Response('<html><body>Pas de résultat pour la lettre</body></html>');

       if($request->isXmlHttpRequest())
        {
            $recherche = new Analyse();

            $saisie = $request->get('lettre');

            $em = $this->getDoctrine()->getManager()->getRepository('MoteurRechercheBundle:Analyse');
            $resultat = $em->rechercheAnalyseButton($saisie);


            if(! $resultat)
            {
                return new Response('<html><body>Pas de résultat pour la lettre '.$saisie.'</body></html>');
            }

            return $this->render('rechercheIndex/liste.html.twig', array('resultat' => $resultat));
        }
        
        return $this->render('rechercheIndex/index.html.twig');
    }

    public function ouvrirAnalyseSimpleAction($id)
    {
        $em = $this->getDoctrine()->getManager()->getRepository('MoteurRechercheBundle:Analyse');
        $analyse = $em->find($id);
        $em2 = $this->getDoctrine()->getManager()->getRepository('MoteurRechercheBundle:NaturePrelevement');
        $prelevement = $em2->find($id);
        $em3 = $this->getDoctrine()->getManager()->getRepository('MoteurRechercheBundle:MicroOrganisme');
        $microorganisme = $em3->find($id);

        if(! $analyse){
            throw $this->createNotFoundException("Erreur : impossible de trouver l'analyse");
        }

        return $this->render('rechercheIndex/analyse_simple.html.twig', array('analyse' => $analyse,'prelevement' =>$prelevement,'microorganisme'=>$microorganisme));

    }
}

