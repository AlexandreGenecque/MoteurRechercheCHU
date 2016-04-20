<?php

namespace MoteurRechercheBundle\Entity;

/**
 * Secteur
 */
class Secteur
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $nomSecteur;

    /**
     * @var \MoteurRechercheBundle\Entity\Laboratoire
     */
    private $laboratoire;


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
     * Set nomSecteur
     *
     * @param string $nomSecteur
     *
     * @return Secteur
     */
    public function setNomSecteur($nomSecteur)
    {
        $this->nomSecteur = $nomSecteur;

        return $this;
    }

    /**
     * Get nomSecteur
     *
     * @return string
     */
    public function getNomSecteur()
    {
        return $this->nomSecteur;
    }

    /**
     * Set laboratoire
     *
     * @param \MoteurRechercheBundle\Entity\Laboratoire $laboratoire
     *
     * @return Secteur
     */
    public function setLaboratoire(\MoteurRechercheBundle\Entity\Laboratoire $laboratoire = null)
    {
        $this->laboratoire = $laboratoire;

        return $this;
    }

    /**
     * Get laboratoire
     *
     * @return \MoteurRechercheBundle\Entity\Laboratoire
     */
    public function getLaboratoire()
    {
        return $this->laboratoire;
    }
}

