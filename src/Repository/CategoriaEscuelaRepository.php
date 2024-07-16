<?php

namespace App\Repository;

use App\Entity\CategoriaEscuela;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<CategoriaEscuela>
 *
 * @method CategoriaEscuela|null find($id, $lockMode = null, $lockVersion = null)
 * @method CategoriaEscuela|null findOneBy(array $criteria, array $orderBy = null)
 * @method CategoriaEscuela[]    findAll()
 * @method CategoriaEscuela[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CategoriaEscuelaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CategoriaEscuela::class);
    }

//    /**
//     * @return CategoriaEscuela[] Returns an array of CategoriaEscuela objects
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

//    public function findOneBySomeField($value): ?CategoriaEscuela
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
