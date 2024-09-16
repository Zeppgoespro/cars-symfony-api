<?php

namespace App\Repository;

use App\Entity\CreditProgram;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<CreditProgram>
 */
class CreditProgramRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CreditProgram::class);
    }

    public function findByInterestRate(float $interestRate): array
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.interest_rate = :interest_rate')
            ->setParameter('interest_rate', $interestRate)
            ->orderBy('c.id', 'ASC')
            ->getQuery()
            ->getResult();
    }

    public function findOneByTitle(string $title): ?CreditProgram
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.title = :title')
            ->setParameter('title', $title)
            ->getQuery()
            ->getOneOrNullResult();
    }

    //    /**
    //     * @return CreditProgram[] Returns an array of CreditProgram objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('c')
    //            ->andWhere('c.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('c.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?CreditProgram
    //    {
    //        return $this->createQueryBuilder('c')
    //            ->andWhere('c.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
