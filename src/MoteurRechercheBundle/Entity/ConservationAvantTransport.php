<?php

namespace MoteurRechercheBundle\Entity;

/**
 * ConservationAvantTransport
 */
class ConservationAvantTransport
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $valeurConservation;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $analyses;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->analyses = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set valeurConservation
     *
     * @param string $valeurConservation
     *
     * @return ConservationAvantTransport
     */
    public function setValeurConservation($valeurConservation)
    {
        $this->valeurConservation = $valeurConservation;

        return $this;
    }

    /**
     * Get valeurConservation
     *
     * @return string
     */
    public function getValeurConservation()
    {
        return $this->valeurConservation;
    }

    /**
     * Add analysis
     *
     * @param \MoteurRechercheBundle\Entity\Analyse $analysis
     *
     * @return ConservationAvantTransport
     */
    public function addAnalysis(\MoteurRechercheBundle\Entity\Analyse $analysis)
    {
        $this->analyses[] = $analysis;

        return $this;
    }

    /**
     * Remove analysis
     *
     * @param \MoteurRechercheBundle\Entity\Analyse $analysis
     */
    public function removeAnalysis(\MoteurRechercheBundle\Entity\Analyse $analysis)
    {
        $this->analyses->removeElement($analysis);
    }

    /**
     * Get analyses
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getAnalyses()
    {
        return $this->analyses;
    }
}

