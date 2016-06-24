<?php

namespace MoteurRechercheBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AnalyseType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nomAnalyse')
            ->add('analyte')
            ->add('natureAnalyse')
            ->add('volumeAnalyse')
            ->add('contenantAnalyse')
            ->add('volumeContenantAnalyse')
            ->add('refGedi')
            ->add('matriceTemperatureTransport')
            ->add('matriceConservationAvantTransport')
            ->add('matriceDelaiAcheminement')
            ->add('codeNomenclature')
            ->add('volumeMinimum')
            ->add('analyseSaintJulien')
            ->add('microOrganisme_analyse')
            ->add('laboratoire')
            ->add('fichePrescription')
            ->add('principeMethode')
            ->add('naturePrelevement')
            ->add('renseignementClinique')
            ->add('conditionPrelevement')
            ->add('transport')
            ->add('conservationAvantTransport')
            ->add('delaiResultat')
            ->add('tube')
            ->add('nomenclatureBBhn')
            ->add('natureMatrice')







        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'MoteurRechercheBundle\Entity\Analyse'
        ));
    }
}
