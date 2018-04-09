<?php

namespace EtablissementBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Ville
 *
 * @ORM\Table(name="ville", indexes={@ORM\Index(name="id_region", columns={"id_region"})})
 * @ORM\Entity(repositoryClass="EtablissementBundle\Repository\VilleRepository")
 */
class Ville
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_ville", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idVille;

    /**
     * @var string
     *
     * @ORM\Column(name="nom_ville", type="string", length=255, nullable=false)
     */
    private $nomVille;

    /**
     * @var \Region
     *
     * @ORM\ManyToOne(targetEntity="Region")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_region", referencedColumnName="id_region")
     * })
     */
    private $idRegion;

    /**
     * @return int
     */
    public function getIdVille()
    {
        return $this->idVille;
    }

    /**
     * @param int $idVille
     */
    public function setIdVille($idVille)
    {
        $this->idVille = $idVille;
    }

    /**
     * @return string
     */
    public function getNomVille()
    {
        return $this->nomVille;
    }

    /**
     * @param string $nomVille
     */
    public function setNomVille($nomVille)
    {
        $this->nomVille = $nomVille;
    }

    /**
     * @return \Region
     */
    public function getIdRegion()
    {
        return $this->idRegion;
    }

    /**
     * @param \Region $idRegion
     */
    public function setIdRegion($idRegion)
    {
        $this->idRegion = $idRegion;
    }


}
