<?php

namespace MoteurRechercheBundle\Entity;

/**
 * ConditionPrelevement
 */
class ConditionPrelevement
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $valeurCP;

    /**
     * @var string
     */
    private $precisionCP;

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
     * Set valeurCP
     *
     * @param string $valeurCP
     *
     * @return ConditionPrelevement
     */
    public function setValeurCP($valeurCP)
    {
        $this->valeurCP = $valeurCP;

        return $this;
    }

    /**
     * Get valeurCP
     *
     * @return string
     */
    public function getValeurCP()
    {
        return $this->valeurCP;
    }

    /**
     * Set precisionCP
     *
     * @param string $precisionCP
     *
     * @return ConditionPrelevement
     */
    public function setPrecisionCP($precisionCP)
    {
        $this->precisionCP = $precisionCP;

        return $this;
    }

    /**
     * Get precisionCP
     *
     * @return string
     */
    public function getPrecisionCP()
    {
        return $this->precisionCP;
    }

    /**
     * Add analysis
     *
     * @param \MoteurRechercheBundle\Entity\Analyse $analysis
     *
     * @return ConditionPrelevement
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

