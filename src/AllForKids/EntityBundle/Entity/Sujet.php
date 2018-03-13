<?php

namespace AllForKids\EntityBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Sujet
 *
 * @ORM\Table(name="sujet")
 * @ORM\Entity
 */
class Sujet
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_sujet", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idSujet;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255, nullable=false)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255, nullable=false)
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="tag", type="string", length=255, nullable=false)
     */
    private $tag;

    /**
     * @var integer
     *
     * @ORM\Column(name="good", type="integer", nullable=false)
     */
    private $good;

    /**
     * @var integer
     *
     * @ORM\Column(name="bad", type="integer", nullable=false)
     */
    private $bad;

    /**
     * @var boolean
     *
     * @ORM\Column(name="visibilite", type="boolean", nullable=false)
     */
    private $visibilite;


}

