<?php

namespace MoteurRechercheBundle\Controller;

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

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('MoteurRechercheBundle:Default:index.html.twig');
    }

    public function generatePDFAction(){

	$em = $this->getDoctrine()->getManager();

    $analyses = $em->getRepository('MoteurRechercheBundle:Analyse')->findBy(array(), array('nomAnalyse' => 'asc'));


	date_default_timezone_set('UTC');
		      
	$mois = date("M");

	 switch($mois)
    	{
    		case "Feb": $mois = "Fev";
    		case "Apr":$mois = "Avr";
    		case "May":$mois = "Mai";
    		case "Jun": $mois = "Juin";
    		case "Jul": $mois  = "Juillet";
    		case "Aug": $mois = "Août";
    	}

	$date = $mois. " " . date("Y");
		    
    $html = $this->renderView('rechercheIndex/analyseSimplePDF.html.twig', array(
    'analyses'  => $analyses
	));

	return new Response($this->get('knp_snappy.pdf')->getOutputFromHtml($html, array(
	 'default-header'=>false,  
	 'footer-center' => '[page]',
	 'page-size' => 'A4',
	 'page-width' => '210mm',
	 'page-height' => '297mm',
	 'dpi' => 100

	 )), 200,
	 array('Content-Type' => 'application/pdf', 'Content-Disposition' => 'attachment; filename="catalogue PBC '.$date.'.pdf"'));
	


    }

    public function convertirDateFR($mois)
    {
    	switch($mois)
    	{
    		case "feb": return "fev";
    		case "apr":return "avr";
    		case "may":return "mai";
    		case "jun": return "juin";
    		case "jul": return "juillet";
    		case "aug": return "août";
    		default: return $mois;
    	}

    }



    public function vidageTableAction(){

    	$entityManager = $this->getDoctrine()->getManager();
    	$connection = $entityManager->getConnection();
		$platform   = $connection->getDatabasePlatform();
  
  		//$connection->executeUpdate($platform->getTruncateTableSQL('micro_organisme', true /* whether to cascade */));

  	$connection->executeQuery('SET FOREIGN_KEY_CHECKS = 0;');
	$truncateSql = $platform->getTruncateTableSQL('analyse');
	$connection->executeUpdate($truncateSql);
	$truncateSql = $platform->getTruncateTableSQL('condition_prelevement');
	$connection->executeUpdate($truncateSql);
	$truncateSql = $platform->getTruncateTableSQL('conservation_avant_transport');
	$connection->executeUpdate($truncateSql);
	$truncateSql = $platform->getTruncateTableSQL('delai_resultat');
	$connection->executeUpdate($truncateSql);
	$truncateSql = $platform->getTruncateTableSQL('fiche_prescription');
	$connection->executeUpdate($truncateSql);
	$truncateSql = $platform->getTruncateTableSQL('laboratoire');
	$connection->executeUpdate($truncateSql);
	$truncateSql = $platform->getTruncateTableSQL('micro_organisme');
	$connection->executeUpdate($truncateSql);
	$truncateSql = $platform->getTruncateTableSQL('micro_organisme_analyse');
	$connection->executeUpdate($truncateSql);
	$truncateSql = $platform->getTruncateTableSQL('nature_matrice');
	$connection->executeUpdate($truncateSql);
	$truncateSql = $platform->getTruncateTableSQL('nature_prelevement');
	$connection->executeUpdate($truncateSql);
	$truncateSql = $platform->getTruncateTableSQL('nomenclature_bbhn');
	$connection->executeUpdate($truncateSql);
	$truncateSql = $platform->getTruncateTableSQL('principe_methode');
	$connection->executeUpdate($truncateSql);
	$truncateSql = $platform->getTruncateTableSQL('renseignement_clinique');
	$connection->executeUpdate($truncateSql);
	$truncateSql = $platform->getTruncateTableSQL('secteur');
	$connection->executeUpdate($truncateSql);
	$truncateSql = $platform->getTruncateTableSQL('transport');
	$connection->executeUpdate($truncateSql);
	$truncateSql = $platform->getTruncateTableSQL('tube');
	$connection->executeUpdate($truncateSql);
	$connection->executeQuery('SET FOREIGN_KEY_CHECKS = 1;');

	return new Response("<html><body>La BDD est vide</body></html>");
    }

	public function jeuxInsertionAction(){

			$laboratoire1 = new Laboratoire();
			$laboratoire2 = new Laboratoire();

			
			$laboratoire1->setnomLaboratoire('Virologie');
			$laboratoire2->setnomLaboratoire('Bactériologie');


			$conditionPrelevement1 = new ConditionPrelevement();
			$conditionPrelevement2 = new ConditionPrelevement();
			$conditionPrelevement3 = new ConditionPrelevement();
			$conditionPrelevement4 = new ConditionPrelevement();


			$conditionPrelevement1->setvaleurCP('Effectuer 2 ou 3 retournements doux du tube EDTA immédiatement après le prélèvement pour éviter la formation de coagulum');
			$conditionPrelevement2->setvaleurCP('');
			$conditionPrelevement3->setvaleurCP('');
			$conditionPrelevement4->setvaleurCP('');
			$conditionPrelevement1->setprecisionCP('');
			$conditionPrelevement2->setprecisionCP('En cas de prélèvement sur Virocult : laisser l"écouvillon dans le milieu de transport.');
			$conditionPrelevement3->setprecisionCP('Couper stérilement 2 fragments distaux de 2.5 cm');
			$conditionPrelevement4->setprecisionCP('Les milieux de transport Chlamydia sont disponibles au laboratoire de Virologie. Ecouvillon : Le bâtonnet doit rester dans le tube de transport après le prélèvement de l"échantillon. Urine : Verser l"urine dans le tube de transport jusqu"à ce que le niveau de liquide atteigne la fenêtre de remplissage située sur l"étiquette du tube');


			$transport1 = new Transport();
			$transport2 = new Transport();
			$transport3 = new Transport();
			$transport4 = new Transport();

			$transport1->settemperatureTransport('température ambiante');
			$transport2->settemperatureTransport('température ambiante');
			$transport3->settemperatureTransport('température ambiante');
			$transport4->settemperatureTransport('température ambiante');

			$transport1->setdelaiTransport('1 jour');
			$transport2->setdelaiTransport('4 jours');
			$transport3->setdelaiTransport('3 jours');
			$transport4->setdelaiTransport('18 jours');

			$natureMatrice1 = new NatureMatrice();
			$natureMatrice2 = new NatureMatrice();
			$natureMatrice3 = new NatureMatrice();
			$natureMatrice4 = new NatureMatrice();
			$natureMatrice5 = new NatureMatrice();
			$natureMatrice6 = new NatureMatrice();
			$natureMatrice7 = new NatureMatrice();
			$natureMatrice8 = new NatureMatrice();

			$natureMatrice1->setvaleurMatrice('Sang');
			$natureMatrice2->setvaleurMatrice('Sérum');
			$natureMatrice3->setvaleurMatrice('Urines');
			$natureMatrice4->setvaleurMatrice('Liquide céphalo rachidien');
			$natureMatrice5->setvaleurMatrice('');
			$natureMatrice6->setvaleurMatrice('');
			$natureMatrice7->setvaleurMatrice('');
			$natureMatrice8->setvaleurMatrice('');

			$natureMatrice1->setprecisionMatrice('');
			$natureMatrice2->setprecisionMatrice('');
			$natureMatrice3->setprecisionMatrice('');
			$natureMatrice4->setprecisionMatrice('');
			$natureMatrice5->setprecisionMatrice('Liquides divers : LCR, amniotique, LBA, Pleural, Péricarde, humeur acqueuse');
			$natureMatrice6->setprecisionMatrice('Sécrétions naso pharyngées, Lavage broncho alvéolaire');
			$natureMatrice7->setprecisionMatrice('Matériel');
			$natureMatrice8->setprecisionMatrice('Prélèvements endocervicaux et vaginaux, urétraux, urine, sperme et liquide divers');

			$conservationAvantTransport1 = new ConservationAvantTransport();
			$conservationAvantTransport2 = new ConservationAvantTransport();

			$conservationAvantTransport1->setvaleurConservation('température ambiante');
			$conservationAvantTransport2->setvaleurConservation('+ 4°C');

			$delaiResultat1 = new DelaiResultat();
			$delaiResultat2 = new DelaiResultat();
			$delaiResultat3 = new DelaiResultat();
			$delaiResultat4 = new DelaiResultat();
			$delaiResultat5 = new DelaiResultat();
			$delaiResultat6 = new DelaiResultat();
			$delaiResultat7 = new DelaiResultat();
			$delaiResultat8 = new DelaiResultat();
			$delaiResultat9 = new DelaiResultat();
			$delaiResultat10 = new DelaiResultat();

			$delaiResultat1->setvaleurResultat('1 jour(s)');
			$delaiResultat2->setvaleurResultat('1 jour(s)');
			$delaiResultat3->setvaleurResultat('2 jour(s)');
			$delaiResultat4->setvaleurResultat('1 jour(s)');
			$delaiResultat5->setvaleurResultat('1 Heure(s)');
			$delaiResultat6->setvaleurResultat('1 Heure(s)');
			$delaiResultat7->setvaleurResultat('2 jour(s)');
			$delaiResultat8->setvaleurResultat('1 jour(s)');
			$delaiResultat9->setvaleurResultat('1 jour(s)');
			$delaiResultat10->setvaleurResultat('1 jour(s)');

			$delaiResultat1->setfrequenceRealisation('Mercredi');
			$delaiResultat2->setfrequenceRealisation('6 jours/7');
			$delaiResultat3->setfrequenceRealisation('1 fois/semaine');
			$delaiResultat4->setfrequenceRealisation('3 fois/semaine');
			$delaiResultat5->setfrequenceRealisation('7 jours/7');
			$delaiResultat6->setfrequenceRealisation('5 jours/7');
			$delaiResultat7->setfrequenceRealisation('6 jours/7');
			$delaiResultat8->setfrequenceRealisation('2 fois/semaine');
			$delaiResultat9->setfrequenceRealisation('Mardi Vendredi');
			$delaiResultat10->setfrequenceRealisation('4 fois/semaine');

			$naturePrelevement1 = new NaturePrelevement();
			$naturePrelevement2 = new NaturePrelevement();
			$naturePrelevement3 = new NaturePrelevement();
			$naturePrelevement4 = new NaturePrelevement();
			$naturePrelevement5 = new NaturePrelevement();
			$naturePrelevement6 = new NaturePrelevement();
			$naturePrelevement7 = new NaturePrelevement();


			$naturePrelevement1->setNomNaturePrelevement('Sang');
			$naturePrelevement2->setNomNaturePrelevement('Urines');
			$naturePrelevement3->setNomNaturePrelevement('Matériel');
			$naturePrelevement4->setNomNaturePrelevement('Liquide céphalo rachidien');
			$naturePrelevement5->setNomNaturePrelevement('');
			$naturePrelevement6->setNomNaturePrelevement('');
			$naturePrelevement7->setNomNaturePrelevement('');

			$naturePrelevement1->setPrecisionPrelevement('');
			$naturePrelevement2->setPrecisionPrelevement('');
			$naturePrelevement3->setPrecisionPrelevement('');
			$naturePrelevement4->setPrecisionPrelevement('');
			$naturePrelevement5->setPrecisionPrelevement('Biopsies et Liquides divers : LCR, amniotique, LBA, Pleural, Péricarde, humeur acqueuse');
			$naturePrelevement6->setPrecisionPrelevement('Sécrétions naso pharyngées, Lavage broncho alvéolaire');
			$naturePrelevement7->setPrecisionPrelevement('Prélevements endocervicaux et vaginaux, urétraux, urine, sperme, liquide divers');


			$principeMethode1 = new PrincipeMethode();
			$principeMethode2 = new PrincipeMethode();
			$principeMethode3 = new PrincipeMethode();
			$principeMethode4 = new PrincipeMethode();
			$principeMethode5 = new PrincipeMethode();

			$principeMethode1->setNomPrincipeMethode('Détection d"acides nucléiques avec amplification, après extraction (PCR en temps réel)   Biologie moléculaire');
			$principeMethode2->setNomPrincipeMethode('Microscopie d"immunofluorescence par marquage immunocytochimique (IF), avec préparation (centrifugation, fixation, coloration)');
			$principeMethode3->setNomPrincipeMethode('Immuno enzymatique (ELISA et dérivées)');
			$principeMethode4->setNomPrincipeMethode('Immunochromatographie et immunofluorescence');
			$principeMethode5->setNomPrincipeMethode('Immunochromatographie');

			$fichePrescription1 = new FichePrescription();
			$fichePrescription2 = new FichePrescription();
			$fichePrescription3 = new FichePrescription();

			$fichePrescription1->setNomFichePrescription('Microbiologie   Virologie');
			$fichePrescription2->setNomFichePrescription('Microbiologie   Sérologies infectieuses');
			$fichePrescription3->setNomFichePrescription('Microbiologie   Bactério BK');

			$microOrganisme1 = new MicroOrganisme();
			$microOrganisme2 = new MicroOrganisme();
			$microOrganisme3 = new MicroOrganisme();
			$microOrganisme4 = new MicroOrganisme();
			$microOrganisme5 = new MicroOrganisme();
			$microOrganisme6 = new MicroOrganisme();
			$microOrganisme7 = new MicroOrganisme();
			$microOrganisme8 = new MicroOrganisme();
			$microOrganisme9 = new MicroOrganisme();

			$microOrganisme1->setNomMicroOrganisme('Adénovirus');
			$microOrganisme2->setNomMicroOrganisme('Streptocoque du groupe A');
			$microOrganisme3->setNomMicroOrganisme('Legionella pneumophila');
			$microOrganisme4->setNomMicroOrganisme('Pneumocoque');
			$microOrganisme5->setNomMicroOrganisme('BK Virus');
			$microOrganisme6->setNomMicroOrganisme('Cathéter');
			$microOrganisme7->setNomMicroOrganisme('VIH');
			$microOrganisme8->setNomMicroOrganisme('Chlamydia trachomatis');
			$microOrganisme9->setNomMicroOrganisme('CMV');

			$analyse1 = new Analyse();
			$analyse2 = new Analyse();
			$analyse3 = new Analyse();
			$analyse4 = new Analyse();
			$analyse5 = new Analyse();
			$analyse6 = new Analyse();
			$analyse7 = new Analyse();
			$analyse8 = new Analyse();
			$analyse9 = new Analyse();
			$analyse10 = new Analyse();
			$analyse11 = new Analyse();
			$analyse12 = new Analyse();
			$analyse13 = new Analyse();

			$analyse1->setNomAnalyse('Adénovirus Charge virale sur sang');
			$analyse1->setAnalyte('ADN');
			$analyse1->setNatureAnalyse('Détermination de la concentration (quantification) d"acide nucléique viral spécifique');
			$analyse1->setVolumeAnalyse('1 ml');
			$analyse1->setContenantAnalyse('1 Tube(s) EDTA');
			$analyse1->setVolumeContenantAnalyse('5 ml');
			$analyse1->setFichePrescription($fichePrescription1);
			$analyse1->setPrincipeMethode($principeMethode1);
			$analyse1->setNaturePrelevement($naturePrelevement1);
			//$analyse1->setRenseignementClinique('');
			$analyse1->setDelaiResultat($delaiResultat1);
			$analyse1->setConservationAvantTransport($conservationAvantTransport1);
			$analyse1->setNatureMatrice($natureMatrice1);
			$analyse1->setTransport($transport1);
			$analyse1->setConditionPrelevement($conditionPrelevement1);
			$analyse1->setLaboratoire($laboratoire1);
			//$analyse1->addMicroOrganismeAnalyse($microOrganisme1);

			$analyse2->setNomAnalyse('Adénovirus PCR sur liquides divers ou biopsies');
			$analyse2->setAnalyte('ADN');
			$analyse2->setNatureAnalyse('Détection d"acide nucléique viral spécifique');
			$analyse2->setVolumeAnalyse('1 ml');
			$analyse2->setContenantAnalyse('1 Flacon(s) sec(s) stérile(s)');
			//$analyse2->setVolumeContenantAnalyse('');
			$analyse2->setFichePrescription($fichePrescription1);
			$analyse2->setPrincipeMethode($principeMethode1);
			$analyse2->setNaturePrelevement($naturePrelevement5);
			//$analyse2->setRenseignementClinique('');
			$analyse2->setDelaiResultat($delaiResultat1);
			$analyse2->setConservationAvantTransport($conservationAvantTransport2);
			$analyse2->setNatureMatrice($natureMatrice5);
			$analyse2->setTransport($transport1);
			//$analyse2->setConditionPrelevement('');
			$analyse2->setLaboratoire($laboratoire1);
			//$analyse2->addMicroOrganismeAnalyse($microOrganisme1);

			$analyse3->setNomAnalyse('Adénovirus sur prélèvement respiratoire (Immunofluorescence)');
			$analyse3->setAnalyte('Antigène');
			$analyse3->setNatureAnalyse('Recherche et identification de virus spécifiques');
			$analyse3->setVolumeAnalyse('2 ml');
			$analyse3->setContenantAnalyse('1 Flacon(s) stérile(s), Ecouvillon(s) (virocult)');
			//$analyse3->setVolumeContenantAnalyse('');
			$analyse3->setFichePrescription($fichePrescription1);
			$analyse3->setPrincipeMethode($principeMethode1);
			$analyse3->setNaturePrelevement($naturePrelevement6);
			//$analyse3->setRenseignementClinique('');
			$analyse3->setDelaiResultat($delaiResultat2);
			$analyse3->setConservationAvantTransport($conservationAvantTransport2);
			$analyse3->setNatureMatrice($natureMatrice6);
			$analyse3->setTransport($transport1);
			$analyse3->setConditionPrelevement($conditionPrelevement2);
			$analyse3->setLaboratoire($laboratoire1);
			//$analyse3->addMicroOrganismeAnalyse($microOrganisme1);

			$analyse4->setNomAnalyse('Anticorps antistreptodornase (ASD)');
			$analyse4->setAnalyte('Anticorps');
			$analyse4->setNatureAnalyse('Recherche,identification (détection) et détermination de la concentration d"anticorps spécifiques contre des agents infectieux.');
			$analyse4->setVolumeAnalyse('3 ml');
			$analyse4->setContenantAnalyse('1 Tube(s) neutre(s)');
			$analyse4->setVolumeContenantAnalyse('5 ml');
			$analyse4->setFichePrescription($fichePrescription2);
			$analyse4->setPrincipeMethode($principeMethode2);
			$analyse4->setNaturePrelevement($naturePrelevement1);
			//$analyse4->setRenseignementClinique('');
			$analyse4->setDelaiResultat($delaiResultat3);
			$analyse4->setConservationAvantTransport($conservationAvantTransport2);
			$analyse4->setNatureMatrice($natureMatrice2);
			$analyse4->setTransport($transport1);
			//$analyse4->setConditionPrelevement('');
			$analyse4->setLaboratoire($laboratoire2);
			//$analyse4->addMicroOrganismeAnalyse($microOrganisme2);

			$analyse5->setNomAnalyse('Antigenurie Legionelle ');
			$analyse5->setAnalyte('Antigène urinaire ');
			$analyse5->setNatureAnalyse("Recherche et identification de toxines ou antigènes bactériens spécifiques");
			$analyse5->setVolumeAnalyse('2 ml');
			$analyse5->setContenantAnalyse('1 Monovette ou flacon sec stérile');
			$analyse5->setVolumeContenantAnalyse('10 ml');
			$analyse5->setFichePrescription($fichePrescription2);
			$analyse5->setPrincipeMethode($principeMethode2);
			$analyse5->setNaturePrelevement($naturePrelevement2);
			//$analyse5->setRenseignementClinique('');
			$analyse5->setDelaiResultat($delaiResultat4);
			$analyse5->setConservationAvantTransport($conservationAvantTransport2);
			$analyse5->setNatureMatrice($natureMatrice3);
			$analyse5->setTransport($transport1);
			//$analyse5->setConditionPrelevement('');
			$analyse5->setLaboratoire($laboratoire2);
			//$analyse5->addMicroOrganismeAnalyse($microOrganisme3);

			$analyse6->setNomAnalyse('Antigenurie Legionelle (Test rapide)');
			$analyse6->setAnalyte('Antigène urinaire ');
			$analyse6->setNatureAnalyse('Recherche et identification d"antigènes bactériens spécifiques ');
			$analyse6->setVolumeAnalyse('2 ml');
			$analyse6->setContenantAnalyse('1 Monovette, tube boraté ou flacon sec stérile');
			$analyse6->setVolumeContenantAnalyse('10 ml');
			$analyse6->setFichePrescription($fichePrescription2);
			$analyse6->setPrincipeMethode($principeMethode2);
			$analyse6->setNaturePrelevement($naturePrelevement2);
			//$analyse6->setRenseignementClinique('');
			$analyse6->setDelaiResultat($delaiResultat5);
			$analyse6->setConservationAvantTransport($conservationAvantTransport2);
			$analyse6->setNatureMatrice($natureMatrice3);
			$analyse6->setTransport($transport1);
			//$analyse6->setConditionPrelevement('');
			$analyse6->setLaboratoire($laboratoire2);
			//$analyse6->addMicroOrganismeAnalyse($microOrganisme3);

			$analyse7->setNomAnalyse('Antigenurie Pneumocoque');
			$analyse7->setAnalyte('Antigène urinaire');
			$analyse7->setNatureAnalyse('Recherche et identification de toxines ou antigènes bactériens spécifiques');
			$analyse7->setVolumeAnalyse('2 ml');
			$analyse7->setContenantAnalyse('1 Monovette ou flacon sec stérile');
			$analyse7->setVolumeContenantAnalyse('10 ml');
			$analyse7->setFichePrescription($fichePrescription2);
			$analyse7->setPrincipeMethode($principeMethode2);
			$analyse7->setNaturePrelevement($naturePrelevement2);
			//$analyse7->setRenseignementClinique('');
			$analyse7->setDelaiResultat($delaiResultat6);
			$analyse7->setConservationAvantTransport($conservationAvantTransport2);
			$analyse7->setNatureMatrice($natureMatrice3);
			$analyse7->setTransport($transport1);
			//$analyse7->setConditionPrelevement('');
			$analyse7->setLaboratoire($laboratoire2);
			//$analyse7->addMicroOrganismeAnalyse($microOrganisme4);

			$analyse8->setNomAnalyse('BK Virus Charge virale sur sang');
			$analyse8->setAnalyte('ADN');
			$analyse8->setNatureAnalyse('Détermination de la concentration (quantification) d"acide nucléique viral spécifique');
			$analyse8->setVolumeAnalyse('1 ml');
			$analyse8->setContenantAnalyse('1 Tube(s) EDTA');
			$analyse8->setVolumeContenantAnalyse('5 ml');
			$analyse8->setFichePrescription($fichePrescription1);
			$analyse8->setPrincipeMethode($principeMethode1);
			$analyse8->setNaturePrelevement($naturePrelevement1);
			//$analyse8->setRenseignementClinique('');
			$analyse8->setDelaiResultat($delaiResultat1);
			$analyse8->setConservationAvantTransport($conservationAvantTransport1);
			$analyse8->setNatureMatrice($natureMatrice1);
			$analyse8->setTransport($transport1);
			//$analyse8->setConditionPrelevement('');
			$analyse8->setLaboratoire($laboratoire1);
			//$analyse8->addMicroOrganismeAnalyse($microOrganisme5);

			$analyse9->setNomAnalyse('BK Virus Charge virale sur urines');
			$analyse9->setAnalyte('ADN');
			$analyse9->setNatureAnalyse('Détermination de la concentration (quantification) d"acide nucléique viral spécifique');
			$analyse9->setVolumeAnalyse('3 ml');
			$analyse9->setContenantAnalyse('1 Flacon(s) sec(s) stérile(s)');
			//$analyse9->setVolumeContenantAnalyse('');
			$analyse9->setFichePrescription($fichePrescription1);
			$analyse9->setPrincipeMethode($principeMethode1);
			$analyse9->setNaturePrelevement($naturePrelevement2);
			//$analyse9->setRenseignementClinique('');
			$analyse9->setDelaiResultat($delaiResultat1);
			$analyse9->setConservationAvantTransport($conservationAvantTransport2);
			$analyse9->setNatureMatrice($natureMatrice3);
			$analyse9->setTransport($transport1);
			//$analyse9->setConditionPrelevement('');
			$analyse9->setLaboratoire($laboratoire1);
			//$analyse9->addMicroOrganismeAnalyse($microOrganisme5);

			$analyse10->setNomAnalyse('Bactériologie : Cathéter');
			//analyse10->setAnalyte('');
			$analyse10->setNatureAnalyse('Recherhe de germes bactériens');
			//$analyse10->setVolumeAnalyse('');
			$analyse10->setContenantAnalyse('1 Flacon(s) sec(s) stérile(s)');
			//$analyse10->setVolumeContenantAnalyse('');
			$analyse10->setFichePrescription($fichePrescription3);
			//$analyse10->setPrincipeMethode($principeMethode3);
			$analyse10->setNaturePrelevement($naturePrelevement3);
			//$analyse10->setRenseignementClinique('');
			$analyse10->setDelaiResultat($delaiResultat7);
			$analyse10->setConservationAvantTransport($conservationAvantTransport2);
			$analyse10->setNatureMatrice($natureMatrice7);
			$analyse10->setTransport($transport1);
			$analyse10->setConditionPrelevement($conditionPrelevement3);
			$analyse10->setLaboratoire($laboratoire2);
			//$analyse10->addMicroOrganismeAnalyse($microOrganisme6);

			$analyse11->setNomAnalyse('Charge virale VIH 1 sur Liquide céphalo rachidien (LCR)');
			$analyse11->setAnalyte('ARN');
			$analyse11->setNatureAnalyse('Détermination de la concentration (quantification) d"acide nucléique viral spécifique');
			$analyse11->setVolumeAnalyse('10 gouttes');
			$analyse11->setContenantAnalyse('1 Flacon(s) sec(s) stérile(s)');
			//$analyse11->setVolumeContenantAnalyse('');
			$analyse11->setFichePrescription($fichePrescription1);
			$analyse11->setPrincipeMethode($principeMethode1);
			$analyse11->setNaturePrelevement($naturePrelevement4);
			//$analyse11->setRenseignementClinique('');
			$analyse11->setDelaiResultat($delaiResultat8);
			$analyse11->setConservationAvantTransport($conservationAvantTransport2);
			$analyse11->setNatureMatrice($natureMatrice4);
			$analyse11->setTransport($transport1);
			//$analyse11->setConditionPrelevement('');
			$analyse11->setLaboratoire($laboratoire1);
			//$analyse11->addMicroOrganismeAnalyse($microOrganisme7);

			$analyse12->setNomAnalyse('Chlamydia trachomatis PCR sur écouvillons génitaux, urines, sperme et liquides divers');
			$analyse12->setAnalyte('ADN');
			$analyse12->setNatureAnalyse('Recherche et identification de bactéries spécifiques (génotypage)');
			//$analyse12->setVolumeAnalyse('');
			$analyse12->setContenantAnalyse('1 Milieu transport Chlamydia');
			//$analyse12->setVolumeContenantAnalyse('');
			$analyse12->setFichePrescription($fichePrescription1);
			$analyse12->setPrincipeMethode($principeMethode1);
			$analyse12->setNaturePrelevement($naturePrelevement7);
			//$analyse12->setRenseignementClinique('');
			$analyse12->setDelaiResultat($delaiResultat9);
			$analyse12->setConservationAvantTransport($conservationAvantTransport1);
			$analyse12->setNatureMatrice($natureMatrice8);
			$analyse12->setTransport($transport1);
			$analyse12->setConditionPrelevement($conditionPrelevement4);
			$analyse12->setLaboratoire($laboratoire1);
			//$analyse12->addMicroOrganismeAnalyse($microOrganisme8);

			$analyse13->setNomAnalyse('CMV Charge virale sur sang');
			$analyse13->setAnalyte('ADN');
			$analyse13->setNatureAnalyse('Détermination de la concentration (quantification) d"acide nucléique viral spécifique');
			$analyse13->setVolumeAnalyse('1 ml');
			$analyse13->setContenantAnalyse('1 Tube(s) EDTA');
			$analyse13->setVolumeContenantAnalyse('5 ml');
			$analyse13->setFichePrescription($fichePrescription1);
			$analyse13->setPrincipeMethode($principeMethode1);
			$analyse13->setNaturePrelevement($naturePrelevement1);
			//$analyse13->setRenseignementClinique('');
			$analyse13->setDelaiResultat($delaiResultat10);
			$analyse13->setConservationAvantTransport($conservationAvantTransport2);
			$analyse13->setNatureMatrice($natureMatrice1);
			$analyse13->setTransport($transport1);
			$analyse13->setConditionPrelevement($conditionPrelevement1);
			$analyse13->setLaboratoire($laboratoire1);
			//$analyse13->addMicroOrganismeAnalyse($microOrganisme9);

			$microOrganisme1->addAnalyseMicroOrganisme($analyse1);





			$em = $this->getDoctrine()->getManager();
			$em->persist($laboratoire1);
			$em->persist($laboratoire2);
			$em->persist($conditionPrelevement1);
			$em->persist($conditionPrelevement2);
			$em->persist($conditionPrelevement3);
			$em->persist($conditionPrelevement4);
			$em->persist($transport1);
			$em->persist($transport2);
			$em->persist($transport3);
			$em->persist($transport4);
			$em->persist($natureMatrice1);
			$em->persist($natureMatrice2);
			$em->persist($natureMatrice3);
			$em->persist($natureMatrice4);
			$em->persist($natureMatrice5);
			$em->persist($natureMatrice6);
			$em->persist($natureMatrice7);
			$em->persist($natureMatrice8);
			$em->persist($conservationAvantTransport1);
			$em->persist($conservationAvantTransport2);
			$em->persist($delaiResultat1);
			$em->persist($delaiResultat2);
			$em->persist($delaiResultat3);
			$em->persist($delaiResultat4);
			$em->persist($delaiResultat5);
			$em->persist($delaiResultat6);
			$em->persist($delaiResultat7);
			$em->persist($delaiResultat8);
			$em->persist($delaiResultat9);
			$em->persist($delaiResultat10);
			$em->persist($naturePrelevement1);
			$em->persist($naturePrelevement2);
			$em->persist($naturePrelevement3);
			$em->persist($naturePrelevement4);
			$em->persist($naturePrelevement5);
			$em->persist($naturePrelevement6);
			$em->persist($naturePrelevement7);
			$em->persist($principeMethode1);
			$em->persist($principeMethode2);
			$em->persist($principeMethode3);
			$em->persist($principeMethode4);
			$em->persist($principeMethode5);
			$em->persist($fichePrescription1);
			$em->persist($fichePrescription2);
			$em->persist($fichePrescription3);
			
			$em->persist($analyse1);
			$em->persist($analyse2);
			$em->persist($analyse3);
			$em->persist($analyse4);
			$em->persist($analyse5);
			$em->persist($analyse6);
			$em->persist($analyse7);
			$em->persist($analyse8);
			$em->persist($analyse9);
			$em->persist($analyse10);
			$em->persist($analyse11);
			$em->persist($analyse12);
			$em->persist($analyse13);

			$em->persist($microOrganisme1);
			$em->persist($microOrganisme2);
			$em->persist($microOrganisme3);
			$em->persist($microOrganisme4);
			$em->persist($microOrganisme5);
			$em->persist($microOrganisme6);
			$em->persist($microOrganisme7);
			$em->persist($microOrganisme8);
			$em->persist($microOrganisme9);

			$em->flush();

			
			return new Response("<html><body>Insertion : OK</body></html>");
		
		}

		public function administrationAction()
    {
        return $this->render('default/administration.html.twig');
    }


}
