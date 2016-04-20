<?php

namespace MoteurRechercheBundle\Entity;

/**
 * NaturePrelevement
 */
class NaturePrelevement
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $nomNaturePrelevement;

    /**
     * @var string
     */
    private $precisionPrelevement;

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
     * Set nomNaturePrelevement
     *
     * @param string $nomNaturePrelevement
     *
     * @return NaturePrelevement
     */
    public function setNomNaturePrelevement($nomNaturePrelevement)
    {
        $this->nomNaturePrelevement = $nomNaturePrelevement;

        return $this;
    }

    /**
     * Get nomNaturePrelevement
     *
     * @return string
     */
    public function getNomNaturePrelevement()
    {
        return $this->nomNaturePrelevement;
    }

    /**
     * Set precisionPrelevement
     *
     * @param string $precisionPrelevement
     *
     * @return NaturePrelevement
     */
    public function setPrecisionPrelevement($precisionPrelevement)
    {
        $this->precisionPrelevement = $precisionPrelevement;

        return $this;
    }

    /**
     * Get precisionPrelevement
     *
     * @return string
     */
    public function getPrecisionPrelevement()
    {
        return $this->precisionPrelevement;
    }

    /**
     * Add analysis
     *
     * @param \MoteurRechercheBundle\Entity\Analyse $analysis
     *
     * @return NaturePrelevement
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

