<?php
namespace App\Factory;

use App\Entity\Alumnos;
use App\Entity\Escuelas;
use Doctrine\ORM\EntityManagerInterface;

class AlumnoFactory implements AlumnoFactoryInterface
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function createAlumno(array $data): Alumnos
    {
        $alumno = new Alumnos();

        if (isset($data['escuela'])) {
            $escuela = $this->entityManager->getRepository(Escuelas::class)->find($data['escuela']);
            $alumno->setEscuela($escuela);
        }

        if (isset($data['categoria'])) {
            $alumno->setCategoria($data['categoria']);
        }

        if (isset($data['cedula'])) {
            $alumno->setCedula($data['cedula']);
        }

        if (isset($data['nombres'])) {
            $alumno->setNombres($data['nombres']);
        }

        if (isset($data['apellidos'])) {
            $alumno->setApellidos($data['apellidos']);
        }

        if (isset($data['genero'])) {
            $alumno->setGenero($data['genero']);
        }

        if (isset($data['estatura'])) {
            $alumno->setEstatura($data['estatura']);
        }

        if (isset($data['peso'])) {
            $alumno->setPeso($data['peso']);
        }

        if (isset($data['edad'])) {
            $alumno->setEdad($data['edad']);
        }

        return $alumno;
    }
}
