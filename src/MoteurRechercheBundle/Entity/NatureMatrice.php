<?php

namespace MoteurRechercheBundle\Entity;

/**
 * NatureMatrice
 */
class NatureMatrice
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $valeurMatrice;

    /**
     * @var string
     */
    private $precisionMatrice;

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
     * Set valeurMatrice
     *
     * @param string $valeurMatrice
     *
     * @return NatureMatrice
     */
    public function setValeurMatrice($valeurMatrice)
    {
        $this->valeurMatrice = $valeurMatrice;

        return $this;
    }

    /**
     * Get valeurMatrice
     *
     * @return string
     */
    public function getValeurMatrice()
    {
        return $this->valeurMatrice;
    }

    /**
     * Set precisionMatrice
     *
     * @param string $precisionMatrice
     *
     * @return NatureMatrice
     */
    public function setPrecisionMatrice($precisionMatrice)
    {
        $this->precisionMatrice = $precisionMatrice;

        return $this;
    }

    /**
     * Get precisionMatrice
     *
     * @return string
     */
    public function getPrecisionMatrice()
    {
        return $this->precisionMatrice;
    }

    /**
     * Add analysis
     *
     * @param \MoteurRechercheBundle\Entity\Analyse $analysis
     *
     * @return NatureMatrice
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

