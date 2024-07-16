<?php
namespace App\Service;

use App\Entity\Alumnos;
use Symfony\Component\HttpFoundation\Request;

class AlumnosValidationService
{
    public function validateAlumnoData(Request $request): array
    {
        $data = json_decode($request->getContent(), true);
        $errors = [];

        if (empty($data['escuela'])) {
            $errors[] = ['error' => 9999, 'mensaje' => 'Falta el campo escuela'];
        }

        if (empty($data['categoria'])) {
            $errors[] = ['error' => 9999, 'mensaje' => 'Falta el campo categoria'];
        }

        if (empty($data['cedula'])) {
            $errors[] = ['error' => 9999, 'mensaje' => 'Falta el campo cedula'];
        }

        if (empty($data['nombres'])) {
            $errors[] = ['error' => 9999, 'mensaje' => 'Falta el campo nombres'];
        }

        if (empty($data['apellidos'])) {
            $errors[] = ['error' => 9999, 'mensaje' => 'Falta el campo apellidos'];
        }

        if (empty($data['genero'])) {
            $errors[] = ['error' => 9999, 'mensaje' => 'Falta el campo genero'];
        }

        if (empty($data['estatura'])) {
            $errors[] = ['error' => 9999, 'mensaje' => 'Falta el campo estatura'];
        }

        if (empty($data['peso'])) {
            $errors[] = ['error' => 9999, 'mensaje' => 'Falta el campo peso'];
        }

        if (empty($data['edad'])) {
            $errors[] = ['error' => 9999, 'mensaje' => 'Falta el campo edad'];
        }

        return $errors;
    }
}
