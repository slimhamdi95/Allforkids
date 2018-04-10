<?php
/**
 * Created by PhpStorm.
 * User: slim
 * Date: 05/04/2018
 * Time: 12:39
 */

namespace AllForKids\EntityBundle\Repository;


class EvenementRepository extends \Doctrine\ORM\EntityRepository
{
    public function findDqlSemaine()
    {
        $q=$this->getEntityManager()
            ->createQuery("select pe FROM AllForKidsEntityBundle:Evenement pe WHERE  CURRENT_DATE()<= pe.date AND 
                        pe.date  <= CURRENT_DATE()+7 ");
        return $q->getResult();

    }
    public function findDqlInscrit($b)
    {
        $q=$this->getEntityManager()
            ->createQuery("select e FROM AllForKidsEntityBundle:Evenement e   
                                             , AllForKidsEntityBundle:Participevenement pe  
                        WHERE  pe.idUser = :id_user AND e.idEvenement = pe.idEvenement")
        ->setParameter('id_user',$b);
        return $q->getResult();

    }
    public function findDqlNomParametre($s)
    {
        $q=$this->getEntityManager()
            ->createQuery("select e FROM AllForKidsEntityBundle:Evenement e WHERE e.nom LIKE :nom ")
            ->setParameter('nom','%'.$s.'%');
        return $q->getResult();

    }
    public function DeleteDqlDep()
    {
        $q=$this->getEntityManager()
            ->createQuery("delete  FROM AllForKidsEntityBundle:Evenement e WHERE e.date < CURRENT_DATE()");

        $q->execute();

    }
}