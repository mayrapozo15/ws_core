<?php
namespace App\Factory;

use App\Entity\Alumnos;

interface AlumnoFactoryInterface
{
    public function createAlumno(array $data): Alumnos;
}
