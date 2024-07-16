<?php

namespace App\Repository;

use App\Entity\RegistroEntrenamiento;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;


class RegistroEntrenamientoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, RegistroEntrenamiento::class);
    }
    
    public function findByDateRange(\DateTime $fecha_inicio, \DateTime $fecha_fin): array
    {
        return $this->createQueryBuilder('r')
        ->select(
            'r.id',
            'r.fecha',
            'rd.id AS id_rutina',
            'rd.nombre AS rutina_nombre',
            'j.id AS jugador_id',
            'j.nombres AS jugador_nombres',
            'j.apellidos AS jugador_apellidos',
            'e.nombre AS escuela_nombre'
        )
        ->innerJoin('r.rutina', 'rd')
        ->innerJoin('r.alumno', 'j')
        ->innerJoin('r.escuela', 'e')
        ->where('r.fecha >= :fecha_inicio')
        ->andWhere('r.fecha <= :fecha_fin')
        ->setParameter('fecha_inicio', $fecha_inicio)
        ->setParameter('fecha_fin', $fecha_fin)
        ->orderBy('r.fecha', 'ASC')
        ->getQuery()
        ->getResult();
    }



}
