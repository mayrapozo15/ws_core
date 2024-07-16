<?php

namespace App\Repository;

use App\Entity\Escuelas;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Escuelas>
 *
 * @method Escuelas|null find($id, $lockMode = null, $lockVersion = null)
 * @method Escuelas|null findOneBy(array $criteria, array $orderBy = null)
 * @method Escuelas[]    findAll()
 * @method Escuelas[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EscuelasRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Escuelas::class);
    }

//    /**
//     * @return Escuelas[] Returns an array of Escuelas objects
//     */
   public function escuelaProfesor($value): array
   {
       return $this->createQueryBuilder('e')
            ->select(
                'a.id',
                'a.categoria',
                'a.cedula',
                'a.nombres',
                'a.apellidos',
                'a.genero',
                'a.estatura',
                'a.peso',
                'a.edad',
                'e.id AS escuela_id',
                'e.nombre AS escuela_nombre',
                'e.direccion AS escuela_direccion',
                'e.categoria AS escuela_categoria'
            )
            ->innerJoin('a.escuela', 'e')
            ->where('e.id = :id')
            ->setParameter('id', $id);
       ;
   }

//    public function findOneBySomeField($value): ?Escuelas
//    {
//        return $this->createQueryBuilder('e')
//            ->andWhere('e.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}