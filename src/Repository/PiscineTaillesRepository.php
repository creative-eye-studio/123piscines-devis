<?php

namespace App\Repository;

use App\Entity\PiscineTailles;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<PiscineTailles>
 *
 * @method PiscineTailles|null find($id, $lockMode = null, $lockVersion = null)
 * @method PiscineTailles|null findOneBy(array $criteria, array $orderBy = null)
 * @method PiscineTailles[]    findAll()
 * @method PiscineTailles[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PiscineTaillesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PiscineTailles::class);
    }

//    /**
//     * @return PiscineTailles[] Returns an array of PiscineTailles objects
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

//    public function findOneBySomeField($value): ?PiscineTailles
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
