<?php

namespace App\Repository;

use App\Entity\CategoriaEstudiante;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<CategoriaEstudiante>
 *
 * @method CategoriaEstudiante|null find($id, $lockMode = null, $lockVersion = null)
 * @method CategoriaEstudiante|null findOneBy(array $criteria, array $orderBy = null)
 * @method CategoriaEstudiante[]    findAll()
 * @method CategoriaEstudiante[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CategoriaEstudianteRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CategoriaEstudiante::class);
    }

//    /**
//     * @return CategoriaEstudiante[] Returns an array of CategoriaEstudiante objects
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

//    public function findOneBySomeField($value): ?CategoriaEstudiante
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
