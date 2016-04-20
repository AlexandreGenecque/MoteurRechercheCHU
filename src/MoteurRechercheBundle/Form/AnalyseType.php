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
            ->add('microOrganisme_analyse')
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
