<?php
namespace App\Service;

use App\Entity\Alumnos;

class AlumnosValidationDecorator implements AlumnoServiceInterface
{
    private $decorated;
    private $alumnosValidationService;

    public function __construct(AlumnoServiceInterface $decorated, AlumnosValidationService $alumnosValidationService)
    {
        $this->decorated = $decorated;
        $this->alumnosValidationService = $alumnosValidationService;
    }

    public function crearOActualizarAlumno($data): Alumnos
    {
        $errors = $this->alumnosValidationService->validateAlumnoData($data);
        if (!empty($errors)) {
            throw new \InvalidArgumentException('Datos de alumno no válidos');
        }

        return $this->decorated->crearOActualizarAlumno($data);
    }

    public function eliminarAlumno(int $id): bool
    {
        return $this->decorated->eliminarAlumno($id);
    }
}
