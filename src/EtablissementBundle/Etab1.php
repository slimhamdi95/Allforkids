<?php
/**
 * Created by PhpStorm.
 * User: FATNASSI
 * Date: 04/05/2018
 * Time: 13:34
 */

namespace EtablissementBundle;


class Etab1
{
    public  $idEtablissement ;
    public  $idUser ;
    public  $nom ;
    public $type ;
    public $region;
    public $ville ;
    public $description;
    public $image;
    public $verification;

    /**
     * Etab1 constructor.
     * @param $id
     * @param $iduser
     * @param $nom
     * @param $type
     * @param $region
     * @param $ville
     * @param $description
     * @param $img
     * @param $verification
     */
    public function __construct($id, $iduser, $nom, $type, $region, $ville, $description, $img, $verification)
    {
        $this->idEtablissement = $id;
        $this->idUser = $iduser;
        $this->nom = $nom;
        $this->type = $type;
        $this->region = $region;
        $this->ville = $ville;
        $this->description = $description;
        $this->image = $img;
        $this->verification = $verification;
    }


}