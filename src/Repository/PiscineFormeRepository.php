<?php

namespace App\Repository;

use App\Entity\PiscineForme;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<PiscineForme>
 *
 * @method PiscineForme|null find($id, $lockMode = null, $lockVersion = null)
 * @method PiscineForme|null findOneBy(array $criteria, array $orderBy = null)
 * @method PiscineForme[]    findAll()
 * @method PiscineForme[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PiscineFormeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PiscineForme::class);
    }

//    /**
//     * @return PiscineForme[] Returns an array of PiscineForme objects
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

//    public function findOneBySomeField($value): ?PiscineForme
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
