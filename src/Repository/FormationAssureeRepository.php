<?php

namespace App\Repository;

use App\Entity\FormationAssuree;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<FormationAssuree>
 *
 * @method FormationAssuree|null find($id, $lockMode = null, $lockVersion = null)
 * @method FormationAssuree|null findOneBy(array $criteria, array $orderBy = null)
 * @method FormationAssuree[]    findAll()
 * @method FormationAssuree[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FormationAssureeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, FormationAssuree::class);
    }

//    /**
//     * @return FormationAssuree[] Returns an array of FormationAssuree objects
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

//    public function findOneBySomeField($value): ?FormationAssuree
//    {
//        return $this->createQueryBuilder('f')
//            ->andWhere('f.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
