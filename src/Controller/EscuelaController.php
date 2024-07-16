<?php

namespace App\Controller;

use App\Entity\Escuelas;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EscuelaController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(): Response
    {
        return $this->json('Bienvenido');
    }

    #[Route('/escuela', name: 'crearEscuela', methods: ['POST'])]
    public function crearEscuela(Request $request, EntityManagerInterface $entityManager): Response
    {
        $data = json_decode($request->getContent(), true);
        // Verificar si se proporcionó un ID en los datos
        if (isset($data['id'])) {
            // Si se proporcionó un ID, buscar la escuela existente
            $escuela = $entityManager->getRepository(Escuelas::class)->find($data['id']);
            if (!$escuela) {
                return $this->json(['error' => 9999, 'mensaje' => 'La escuela con el ID proporcionado no existe']);
            }
        } else {
            $escuela = new Escuelas();
        }
        if (isset($data['nombre']) && $data['nombre'] !== '') {
            $escuela->setNombre(strtoupper($data['nombre']));
        } else {
            return $this->json(['error' => 9999, 'mensaje' => 'Falta el campo nombre']);
        }

        if (isset($data['direccion']) && $data['direccion'] !== '') {
            $escuela->setDireccion(strtoupper($data['direccion']));
        } else {
            return $this->json(['error' => 9999, 'mensaje' => 'Falta el campo direccion']);
        }
        if (isset($data['categoria']) && $data['categoria'] !== '') {
            $escuela->setCategoria($data['categoria']);
        } else {
            return $this->json(['error' => 9999, 'mensaje' => 'Falta el campo direccioncategoriacategoria']);
        }
        // Persistir y guardar los cambios en la base de datos
        $entityManager->persist($escuela);
        $entityManager->flush();

        // Devolver una respuesta de éxito
        if (isset($data['id'])) {
            return $this->json( ['error' => 0, 'mensaje' =>'Escuela actualizada correctamente', 'datos' => [$escuela]]);
        } else {
            return $this->json(['error' => 0,'mensaje' =>'Escuela ingresado correctamente', 'datos' => [$escuela]]);
        }
    }

    #[Route('/escuela/{id<\d+>?}', name: 'consultarEscuela', methods: ['GET'])]
    public function consultarEscuelaPorId(?int $id, EntityManagerInterface $entityManager): Response
    {
        if ($id === null) {
            $escuelas = $entityManager->getRepository(Escuelas::class)->findAll();
            return $this->json(['error' => 0, 'mensaje' => 'OK', 'datos' => $escuelas]);
        }
        $escuela[0] = $entityManager->getRepository(Escuelas::class)->find($id);
        if (!$escuela) {
            return $this->json(['error' => 0, 'mensaje' => 'La escuela con el ID proporcionado no existe']);
        }
        if ($escuela[0] == null)
            return $this->json(
                ['error' => 9999, 'mensaje' => 'No cuenta con datos' ]
            );
        return $this->json(['error' => 0, 'mensaje' => 'OK', 'datos' => $escuela]);
    }
    #[Route('/escuelaEliminar/{id}', name: 'eliminarEscuelaPorId', methods: ['GET'])]
    public function eliminarEscuelaPorId($id, EntityManagerInterface $entityManager): Response
    {
        $escuela = $entityManager->getRepository(Escuelas::class)->find($id);
        if (!$escuela) {
            return $this->json(['error' => 0, 'mensaje' => 'La escuela con el ID proporcionado no existe']);
        }
        $entityManager->remove($escuela);
        $entityManager->flush();
        return $this->json(['error' => 0, 'mensaje' => 'Eliminado correctamente']);
    }

    #[Route('/escuela_profesor/{id}', name: 'consultarEscuelaPorprofesor', methods: ['GET'])]
    public function consultarEscuelaPorprofesor(?int $id, EntityManagerInterface $entityManager): Response
    {
        if ($id === null) {
            $escuelas = $entityManager->getRepository(Escuelas::class)->findAll();
            return $this->json(['error' => 0, 'mensaje' => 'OK', 'datos' => $escuelas]);
        }
        $escuela[0] = $entityManager->getRepository(Escuelas::class)->find($id);
        if (!$escuela) {
            return $this->json(['error' => 0, 'mensaje' => 'La escuela con el ID proporcionado no existe']);
        }
        if ($escuela[0] == null)
            return $this->json(['error' => 9999, 'mensaje' => 'No cuenta con datos' ]);
        return $this->json(['error' => 0, 'mensaje' => 'OK', 'datos' => $escuela]);
    }
}