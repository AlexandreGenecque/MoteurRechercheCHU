<?php

namespace MoteurRechercheBundle\Entity;

/**
 * Laboratoire
 */
class Laboratoire
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $nomLaboratoire;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $analyses;

    /**
     * @var \MoteurRechercheBundle\Entity\Analyse
     */
    private $analyse;

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
     * Set nomLaboratoire
     *
     * @param string $nomLaboratoire
     *
     * @return Laboratoire
     */
    public function setNomLaboratoire($nomLaboratoire)
    {
        $this->nomLaboratoire = $nomLaboratoire;

        return $this;
    }

    /**
     * Get nomLaboratoire
     *
     * @return string
     */
    public function getNomLaboratoire()
    {
        return $this->nomLaboratoire;
    }

    /**
     * Add analysis
     *
     * @param \MoteurRechercheBundle\Entity\Analyse $analysis
     *
     * @return Laboratoire
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

    /**
     * Set analyse
     *
     * @param \MoteurRechercheBundle\Entity\Analyse $analyse
     *
     * @return Laboratoire
     */
    public function setAnalyse(\MoteurRechercheBundle\Entity\Analyse $analyse = null)
    {
        $this->analyse = $analyse;

        return $this;
    }

    /**
     * Get analyse
     *
     * @return \MoteurRechercheBundle\Entity\Analyse
     */
    public function getAnalyse()
    {
        return $this->analyse;
    }
}

