<?php
namespace App\Controller;

use App\Repository\AlumnosRepository;
use App\Service\AlumnosService;
use App\Service\AlumnosValidationService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AlumnosController extends AbstractController
{
    private $alumnosRepository;
    private $alumnosService;
    private $alumnosValidationService;

    public function __construct(
        AlumnosRepository $alumnosRepository,
        AlumnosService $alumnosService,
        AlumnosValidationService $alumnosValidationService
    ) {
        $this->alumnosRepository = $alumnosRepository;
        $this->alumnosService = $alumnosService;
        $this->alumnosValidationService = $alumnosValidationService;
    }

    #[Route('/alumnoNuevo', name: 'crearAlumno', methods: ['POST'])]
    public function crearAlumno(Request $request): Response
    {
        $errors = $this->alumnosValidationService->validateAlumnoData($request);
        if (!empty($errors)) {
            return $this->json($errors, Response::HTTP_BAD_REQUEST);
        }

        $data = json_decode($request->getContent(), true);
        $alumno = $this->alumnosService->crearOActualizarAlumno($data);

        return $this->json(['error' => 0, 'mensaje' =>'Alumno ingresado correctamente', 'datos' => [$alumno]]);
    }

    #[Route('/alumno/{id<\d+>?}', name: 'consultarAlumno', methods: ['GET'])]
    public function consultarAlumnoPorId(?int $id): Response
    {
        if ($id !== null) {
            $alumnos = $this->alumnosRepository->findAlumnosCompleto($id);
            if ($alumnos) {
                return $this->json(['error' => 0, 'mensaje' => 'OK', 'datos' => $alumnos]);
            }
            return $this->json(['error' => 9999, 'mensaje' => 'No cuenta con datos']);
        } else {
            $alumnos = $this->alumnosRepository->findTodosAlumnosCompleto();
            if ($alumnos) {
                return $this->json(['error' => 0, 'mensaje' => 'OK', 'datos' => $alumnos]);
            }
            return $this->json(['error' => 9999, 'mensaje' => 'No cuenta con datos']);
        }
    }

    #[Route('/alumnoEliminar/{id<\d+>?}', name: 'eliminarAlumno', methods: ['GET'])]
    public function eliminarAlumno(?int $id): Response
    {
        if ($id === null) {
            return $this->json(['error' => 9998, 'mensaje' => 'ID no proporcionado'], Response::HTTP_BAD_REQUEST);
        }

        $success = $this->alumnosService->eliminarAlumno($id);

        if ($success) {
            return $this->json(['error' => 0, 'mensaje' => 'Eliminado correctamente']);
        } else {
            return $this->json(['error' => 9999, 'mensaje' => 'El alumno con el ID proporcionado no existe'], Response::HTTP_NOT_FOUND);
        }
    }

    #[Route('/alumno_escuela/{id<\d+>?}', name: 'consultarAlumnoPorEscuela', methods: ['GET'])]
    public function consultarAlumnoPorEscuela(?int $id): Response
    {
        if ($id === null) {
            return $this->json(['error' => 9998, 'mensaje' => 'ID no proporcionado'], Response::HTTP_BAD_REQUEST);
        }

        $alumnos = $this->alumnosRepository->findAlumnosByEscuelaId($id);
        if ($alumnos) {
            return $this->json(['error' => 0, 'mensaje' => 'OK', 'datos' => $alumnos]);
        }

        return $this->json(['error' => 9999, 'mensaje' => 'No cuenta con datos'], Response::HTTP_NOT_FOUND);
    }
}
