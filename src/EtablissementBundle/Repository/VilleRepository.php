<?php
namespace EtablissementBundle\Repository;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query;
use EtablissementBundle\Entity\Ville;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

class VilleRepository extends EntityRepository
{

    public function getVilles($id){
        $qb = $this->createQueryBuilder('v')
            ->andWhere('v.idRegion= :region')
            ->setParameter('region', $id)
            ->getQuery();
        $result = $qb->getResult(Query::HYDRATE_ARRAY);
        return $result;
    }
}