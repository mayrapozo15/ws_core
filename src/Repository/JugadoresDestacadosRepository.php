<?php

namespace App\Repository;

use App\Entity\JugadoresDestacados;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class JugadoresDestacadosRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, JugadoresDestacados::class);
    }
    public function findJugadorId($id): ?JugadoresDestacados
    {
        return $this->createQueryBuilder('j')
            ->andWhere('j.id = :id')
            ->setParameter('id', $id)
            ->getQuery()
            ->getOneOrNullResult();
    }
    // public function findTodosJugadoresConrutinas(): array
    // {
    //     $qb = $this->createQueryBuilder('j')
    //         ->select(
    //             'j.id',
    //             'j.categoria',
    //             'j.nombres',
    //             'j.apellidos',
    //             'j.genero',
    //             'j.estatura',
    //             'j.peso',
    //             'j.edad',
    //             'c.id AS categoria_id',
    //             'c.nombre AS categoria_nombre'
    //         )
    //         ->innerJoin('j.categoriaEstudiante', 'c');

    //     return $qb->getQuery()->getArrayResult();
    // }
}
