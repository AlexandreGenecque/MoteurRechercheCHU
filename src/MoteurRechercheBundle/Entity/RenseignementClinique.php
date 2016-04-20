<?php

namespace MoteurRechercheBundle\Entity;

/**
 * RenseignementClinique
 */
class RenseignementClinique
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $valeurRC;

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
     * Set valeurRC
     *
     * @param string $valeurRC
     *
     * @return RenseignementClinique
     */
    public function setValeurRC($valeurRC)
    {
        $this->valeurRC = $valeurRC;

        return $this;
    }

    /**
     * Get valeurRC
     *
     * @return string
     */
    public function getValeurRC()
    {
        return $this->valeurRC;
    }

    /**
     * Add analysis
     *
     * @param \MoteurRechercheBundle\Entity\Analyse $analysis
     *
     * @return RenseignementClinique
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

