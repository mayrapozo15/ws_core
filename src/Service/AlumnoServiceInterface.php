<?php
namespace App\Service;

use App\Entity\Alumnos;

interface AlumnoServiceInterface
{
    public function crearOActualizarAlumno(array $data): Alumnos;
    public function eliminarAlumno(int $id): bool;
}
