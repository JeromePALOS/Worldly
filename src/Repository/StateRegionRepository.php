<?php

namespace App\Repository;

use App\Entity\StateRegion;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method StateRegion|null find($id, $lockMode = null, $lockVersion = null)
 * @method StateRegion|null findOneBy(array $criteria, array $orderBy = null)
 * @method StateRegion[]    findAll()
 * @method StateRegion[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class StateRegionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, StateRegion::class);
    }

    // /**
    //  * @return StateRegion[] Returns an array of StateRegion objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?StateRegion
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
