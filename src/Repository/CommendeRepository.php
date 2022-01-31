<?php

namespace App\Repository;

use App\Entity\Commende;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Commende|null find($id, $lockMode = null, $lockVersion = null)
 * @method Commende|null findOneBy(array $criteria, array $orderBy = null)
 * @method Commende[]    findAll()
 * @method Commende[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CommendeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Commende::class);
    }

    // /**
    //  * @return Commende[] Returns an array of Commende objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Commende
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
