<?php

namespace App\Repository;

use App\Entity\PiscineColors;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<PiscineColors>
 *
 * @method PiscineColors|null find($id, $lockMode = null, $lockVersion = null)
 * @method PiscineColors|null findOneBy(array $criteria, array $orderBy = null)
 * @method PiscineColors[]    findAll()
 * @method PiscineColors[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PiscineColorsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PiscineColors::class);
    }

//    /**
//     * @return PiscineColors[] Returns an array of PiscineColors objects
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

//    public function findOneBySomeField($value): ?PiscineColors
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
