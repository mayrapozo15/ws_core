<?php

namespace App\Repository;

use App\Entity\JugadoresTitulos;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<JugadoresTitulos>
 *
 * @method JugadoresTitulos|null find($id, $lockMode = null, $lockVersion = null)
 * @method JugadoresTitulos|null findOneBy(array $criteria, array $orderBy = null)
 * @method JugadoresTitulos[]    findAll()
 * @method JugadoresTitulos[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class JugadoresTitulosRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, JugadoresTitulos::class);
    }

//    /**
//     * @return JugadoresTitulos[] Returns an array of JugadoresTitulos objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('j')
//            ->andWhere('j.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('j.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?JugadoresTitulos
//    {
//        return $this->createQueryBuilder('j')
//            ->andWhere('j.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
