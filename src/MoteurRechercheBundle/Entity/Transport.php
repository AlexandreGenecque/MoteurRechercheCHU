<?php

namespace MoteurRechercheBundle\Entity;

/**
 * Transport
 */
class Transport
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $temperatureTransport;

    /**
     * @var string
     */
    private $delaiTransport;

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
     * Set temperatureTransport
     *
     * @param string $temperatureTransport
     *
     * @return Transport
     */
    public function setTemperatureTransport($temperatureTransport)
    {
        $this->temperatureTransport = $temperatureTransport;

        return $this;
    }

    /**
     * Get temperatureTransport
     *
     * @return string
     */
    public function getTemperatureTransport()
    {
        return $this->temperatureTransport;
    }

    /**
     * Set delaiTransport
     *
     * @param string $delaiTransport
     *
     * @return Transport
     */
    public function setDelaiTransport($delaiTransport)
    {
        $this->delaiTransport = $delaiTransport;

        return $this;
    }

    /**
     * Get delaiTransport
     *
     * @return string
     */
    public function getDelaiTransport()
    {
        return $this->delaiTransport;
    }

    /**
     * Add analysis
     *
     * @param \MoteurRechercheBundle\Entity\Analyse $analysis
     *
     * @return Transport
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

