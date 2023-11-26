<?php

namespace App\Repository;

use App\Entity\Filtrations;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Filtrations>
 *
 * @method Filtrations|null find($id, $lockMode = null, $lockVersion = null)
 * @method Filtrations|null findOneBy(array $criteria, array $orderBy = null)
 * @method Filtrations[]    findAll()
 * @method Filtrations[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FiltrationsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Filtrations::class);
    }

//    /**
//     * @return Filtrations[] Returns an array of Filtrations objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('f')
//            ->andWhere('f.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('f.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Filtrations
//    {
//        return $this->createQueryBuilder('f')
//            ->andWhere('f.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
