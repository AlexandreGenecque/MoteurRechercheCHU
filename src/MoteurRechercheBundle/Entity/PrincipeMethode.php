<?php

namespace MoteurRechercheBundle\Entity;

/**
 * PrincipeMethode
 */
class PrincipeMethode
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $nomPrincipeMethode;

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
     * Set nomPrincipeMethode
     *
     * @param string $nomPrincipeMethode
     *
     * @return PrincipeMethode
     */
    public function setNomPrincipeMethode($nomPrincipeMethode)
    {
        $this->nomPrincipeMethode = $nomPrincipeMethode;

        return $this;
    }

    /**
     * Get nomPrincipeMethode
     *
     * @return string
     */
    public function getNomPrincipeMethode()
    {
        return $this->nomPrincipeMethode;
    }

    /**
     * Add analysis
     *
     * @param \MoteurRechercheBundle\Entity\Analyse $analysis
     *
     * @return PrincipeMethode
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

