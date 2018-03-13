<?php

namespace AllForKids\EntityBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CategorieService
 *
 * @ORM\Table(name="categorie_service")
 * @ORM\Entity
 */
class CategorieService
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="text", length=65535, nullable=false)
     */
    private $nom;


}

