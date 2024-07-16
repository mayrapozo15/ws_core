<?php

namespace App\Repository;

use App\Entity\RutinaDeportivas;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class RutinaDeportivasRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, RutinaDeportivas::class);
    }

    public function findRutinasId($id): ?RutinaDeportivas
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.id = :id')
            ->setParameter('id', $id)
            ->getQuery()
            ->getOneOrNullResult();
    }
    public function findAllRutinasCompletas(): array
    {
        $qb = $this->createQueryBuilder('r')
            ->select(
                'r.id',
                'r.jugador',
                'r.dia',
                'r.nombre',
                'r.repeticiones',
                'j.id AS jugador_id',
                'j.nombres AS jugador_nombres',
                'j.apellidos AS jugador_apellidos'
            )
            ->innerJoin('r.jugadorDestacado', 'j');

        return $qb->getQuery()->getArrayResult();
    }
    public function findAllRutinasPorJugador($id): array
    {
        $qb = $this->createQueryBuilder('r')
            ->select(
                'r.id',
                'r.jugador',
                'r.dia',
                'r.nombre',
                'r.repeticiones',
                'j.id AS jugador_id',
                'j.nombres AS jugador_nombres',
                'j.apellidos AS jugador_apellidos'
            )
            ->innerJoin('r.jugadorDestacado', 'j')
            ->where('r.jugador = :id')
            ->setParameter('id', $id);

        return $qb->getQuery()->getArrayResult();
    }
}
