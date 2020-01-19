<?php

namespace App\Repository;

use App\Entity\StateUser;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method StateUser|null find($id, $lockMode = null, $lockVersion = null)
 * @method StateUser|null findOneBy(array $criteria, array $orderBy = null)
 * @method StateUser[]    findAll()
 * @method StateUser[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class StateUserRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, StateUser::class);
    }

    // /**
    //  * @return StateUser[] Returns an array of StateUser objects
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
    public function findOneBySomeField($value): ?StateUser
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
