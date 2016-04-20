<?php

namespace MoteurRechercheBundle\Entity;

/**
 * DelaiResultat
 */
class DelaiResultat
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $valeurResultat;

    /**
     * @var string
     */
    private $frequenceRealisation;

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
     * Set valeurResultat
     *
     * @param string $valeurResultat
     *
     * @return DelaiResultat
     */
    public function setValeurResultat($valeurResultat)
    {
        $this->valeurResultat = $valeurResultat;

        return $this;
    }

    /**
     * Get valeurResultat
     *
     * @return string
     */
    public function getValeurResultat()
    {
        return $this->valeurResultat;
    }

    /**
     * Set frequenceRealisation
     *
     * @param string $frequenceRealisation
     *
     * @return DelaiResultat
     */
    public function setFrequenceRealisation($frequenceRealisation)
    {
        $this->frequenceRealisation = $frequenceRealisation;

        return $this;
    }

    /**
     * Get frequenceRealisation
     *
     * @return string
     */
    public function getFrequenceRealisation()
    {
        return $this->frequenceRealisation;
    }

    /**
     * Add analysis
     *
     * @param \MoteurRechercheBundle\Entity\Analyse $analysis
     *
     * @return DelaiResultat
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

