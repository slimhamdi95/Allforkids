<?php

namespace EtablissementBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Matiere
 *
 * @ORM\Table(name="matiere")
 * @ORM\Entity(repositoryClass="EtablissementBundle\Repository\MatiereRepository")
 */
class Matiere
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nom_matiere", type="string", length=255)
     */
    private $nomMatiere;

    /**
     * @var float
     *
     * @ORM\Column(name="coeff", type="float")
     */
    private $coeff;

    /**
     * @ORM\OneToMany(targetEntity="EtablissementBundle\Entity\Note", mappedBy="matiere", fetch="EXTRA_LAZY")
     */
    private $notes;

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
     * Set nomMatiere
     *
     * @param string $nomMatiere
     *
     * @return Matiere
     */
    public function setNomMatiere($nomMatiere)
    {
        $this->nomMatiere = $nomMatiere;

        return $this;
    }

    /**
     * Get nomMatiere
     *
     * @return string
     */
    public function getNomMatiere()
    {
        return $this->nomMatiere;
    }

    /**
     * Set coeff
     *
     * @param float $coeff
     *
     * @return Matiere
     */
    public function setCoeff($coeff)
    {
        $this->coeff = $coeff;

        return $this;
    }

    /**
     * Get coeff
     *
     * @return float
     */
    public function getCoeff()
    {
        return $this->coeff;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->notes = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add note
     *
     * @param \EtablissementBundle\Entity\Note $note
     *
     * @return Matiere
     */
    public function addNote(\EtablissementBundle\Entity\Note $note)
    {
        $this->notes[] = $note;

        return $this;
    }

    /**
     * Remove note
     *
     * @param \EtablissementBundle\Entity\Note $note
     */
    public function removeNote(\EtablissementBundle\Entity\Note $note)
    {
        $this->notes->removeElement($note);
    }

    /**
     * Get notes
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getNotes()
    {
        return $this->notes;
    }
    public function __toString()
    {
        return $this->nomMatiere;
    }
}
