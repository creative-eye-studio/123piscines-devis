<?php

namespace App\Repository;

use App\Entity\PiscineEsc;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<PiscineEsc>
 *
 * @method PiscineEsc|null find($id, $lockMode = null, $lockVersion = null)
 * @method PiscineEsc|null findOneBy(array $criteria, array $orderBy = null)
 * @method PiscineEsc[]    findAll()
 * @method PiscineEsc[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PiscineEscRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PiscineEsc::class);
    }

//    /**
//     * @return PiscineEsc[] Returns an array of PiscineEsc objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('p.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?PiscineEsc
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
