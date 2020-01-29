<?php

namespace App\Repository;

use App\Entity\TypeRegion;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method RegionType|null find($id, $lockMode = null, $lockVersion = null)
 * @method RegionType|null findOneBy(array $criteria, array $orderBy = null)
 * @method RegionType[]    findAll()
 * @method RegionType[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TypeRegionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TypeRegion::class);
    }

    // /**
    //  * @return RegionType[] Returns an array of RegionType objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('r.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?RegionType
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
