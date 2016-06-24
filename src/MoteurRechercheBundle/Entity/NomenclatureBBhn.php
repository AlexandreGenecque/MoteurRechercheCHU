<?php

namespace MoteurRechercheBundle\Entity;

/**
 * NomenclatureBBhn
 */
class NomenclatureBBhn
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $valeurNomenclature;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set valeurNomenclature
     *
     * @param string $valeurNomenclature
     *
     * @return NomenclatureBBhn
     */
    public function setValeurNomenclature($valeurNomenclature)
    {
        $this->valeurNomenclature = $valeurNomenclature;

        return $this;
    }

    /**
     * Get valeurNomenclature
     *
     * @return string
     */
    public function getValeurNomenclature()
    {
        return $this->valeurNomenclature;
    }
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
     * Add analysis
     *
     * @param \MoteurRechercheBundle\Entity\Analyse $analysis
     *
     * @return NomenclatureBBhn
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

    public function __toString()
    {
        return $this->valeurNomenclature;
    }
}
