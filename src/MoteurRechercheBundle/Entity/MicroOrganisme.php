<?php

namespace MoteurRechercheBundle\Entity;

/**
 * MicroOrganisme
 */
class MicroOrganisme
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $nomMicroOrganisme;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $analyse_microOrganisme;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->analyse_microOrganisme = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set nomMicroOrganisme
     *
     * @param string $nomMicroOrganisme
     *
     * @return MicroOrganisme
     */
    public function setNomMicroOrganisme($nomMicroOrganisme)
    {
        $this->nomMicroOrganisme = $nomMicroOrganisme;

        return $this;
    }

    /**
     * Get nomMicroOrganisme
     *
     * @return string
     */
    public function getNomMicroOrganisme()
    {
        return $this->nomMicroOrganisme;
    }

    /**
     * Add analyseMicroOrganisme
     *
     * @param \MoteurRechercheBundle\Entity\Analyse $analyseMicroOrganisme
     *
     * @return MicroOrganisme
     */
    public function addAnalyseMicroOrganisme(\MoteurRechercheBundle\Entity\Analyse $analyseMicroOrganisme)
    {
        $this->analyse_microOrganisme[] = $analyseMicroOrganisme;

        return $this;
    }

    /**
     * Remove analyseMicroOrganisme
     *
     * @param \MoteurRechercheBundle\Entity\Analyse $analyseMicroOrganisme
     */
    public function removeAnalyseMicroOrganisme(\MoteurRechercheBundle\Entity\Analyse $analyseMicroOrganisme)
    {
        $this->analyse_microOrganisme->removeElement($analyseMicroOrganisme);
    }

    /**
     * Get analyseMicroOrganisme
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getAnalyseMicroOrganisme()
    {
        return $this->analyse_microOrganisme;
    }
}

