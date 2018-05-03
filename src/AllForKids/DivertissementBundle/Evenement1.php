<?php
/**
 * Created by PhpStorm.
 * User: slim
 * Date: 01/05/2018
 * Time: 01:01
 */

namespace AllForKids\DivertissementBundle;


class Evenement1
{
   public $idEvenement ;
   public $descriptionn ;
   public $date ;
   public $nom ;
     public $type ;
    public $nbrParticipation;
    public $photo;
public $etat;
public $latitude;
public $longitude;
public $temp;
public $idUser;

    /**
     * Evenement1 constructor.
     * @param $idEvenement
     * @param $descriptionn
     * @param $date
     * @param $nom
     * @param $type
     * @param $nbrParticipation
     * @param $photo
     * @param $etat
     * @param $latitude
     * @param $longitude
     * @param $temp
     * @param $idUser
     */
    public function __construct($idEvenement, $descriptionn, $date, $nom, $type, $nbrParticipation, $photo, $etat, $latitude, $longitude, $temp, $idUser)
    {
        $this->idEvenement = $idEvenement;
        $this->descriptionn = $descriptionn;
        $this->date = $date;
        $this->nom = $nom;
        $this->type = $type;
        $this->nbrParticipation = $nbrParticipation;
        $this->photo = $photo;
        $this->etat = $etat;
        $this->latitude = $latitude;
        $this->longitude = $longitude;
        $this->temp = $temp;
        $this->idUser = $idUser;
    }


}