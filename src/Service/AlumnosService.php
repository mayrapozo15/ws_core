<?php
namespace App\Service;

use App\Entity\Alumnos;
use App\Entity\Escuelas;
use App\Factory\AlumnoFactoryInterface;
use Doctrine\ORM\EntityManagerInterface;

class AlumnosService implements AlumnoServiceInterface
{
    private $entityManager;
    private $alumnoFactory;

    public function __construct(EntityManagerInterface $entityManager, AlumnoFactoryInterface $alumnoFactory)
    {
        $this->entityManager = $entityManager;
        $this->alumnoFactory = $alumnoFactory;
    }

    public function crearOActualizarAlumno(array $data): Alumnos
    {
        $alumno = isset($data['id']) ? $this->entityManager->getRepository(Alumnos::class)->find($data['id']) : $this->alumnoFactory->createAlumno($data);

        // Si es actualización, actualizamos los campos necesarios
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

        $this->entityManager->persist($alumno);
        $this->entityManager->flush();

        return $alumno;
    }

    public function eliminarAlumno(int $id): bool
    {
        $alumno = $this->entityManager->getRepository(Alumnos::class)->find($id);
        if ($alumno) {
            $this->entityManager->remove($alumno);
            $this->entityManager->flush();
            return true;
        }
        return false;
    }
}
