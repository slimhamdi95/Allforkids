<?php

namespace EtablissementBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Region
 *
 * @ORM\Table(name="region")
 * @ORM\Entity
 */
class Region
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_region", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idRegion;

    /**
     * @var string
     *
     * @ORM\Column(name="nom_region", type="string", length=255, nullable=false)
     */
    private $nomRegion;

    /**
     * @return int
     */
    public function getIdRegion()
    {
        return $this->idRegion;
    }

    /**
     * @param int $idRegion
     */
    public function setIdRegion($idRegion)
    {
        $this->idRegion = $idRegion;
    }

    /**
     * @return string
     */
    public function getNomRegion()
    {
        return $this->nomRegion;
    }

    /**
     * @param string $nomRegion
     */
    public function setNomRegion($nomRegion)
    {
        $this->nomRegion = $nomRegion;
    }

    function __toString()
    {
        return $this->nomRegion;
    }


}
