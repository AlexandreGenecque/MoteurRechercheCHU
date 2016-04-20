<?php

namespace MoteurRechercheBundle\Entity;

/**
 * FichePrescription
 */
class FichePrescription
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $nomFichePrescription;

    /**
     * @var string
     */
    private $url;

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
     * Set nomFichePrescription
     *
     * @param string $nomFichePrescription
     *
     * @return FichePrescription
     */
    public function setNomFichePrescription($nomFichePrescription)
    {
        $this->nomFichePrescription = $nomFichePrescription;

        return $this;
    }

    /**
     * Get nomFichePrescription
     *
     * @return string
     */
    public function getNomFichePrescription()
    {
        return $this->nomFichePrescription;
    }

    /**
     * Set url
     *
     * @param string $url
     *
     * @return FichePrescription
     */
    public function setUrl($url)
    {
        $this->url = $url;

        return $this;
    }

    /**
     * Get url
     *
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Add analysis
     *
     * @param \MoteurRechercheBundle\Entity\Analyse $analysis
     *
     * @return FichePrescription
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

