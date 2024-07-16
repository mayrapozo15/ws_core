<?php

namespace App\Controller;

use App\Entity\CategoriaEscuela;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CategoriaEscuelaController extends AbstractController
{
    #[Route('/categoria_escuela', name: 'crearCategoriaEscuela', methods: ['POST'])]
    public function crearCategoriaEscuela(Request $request, EntityManagerInterface $entityManager): Response
    {
        $data = json_decode($request->getContent(), true);
        if (isset($data['id'])) {
            $categoria_escuela = $entityManager->getRepository(CategoriaEscuela::class)->find($data['id']);
            if (!$categoria_escuela) {
                return $this->json(['error' => 'La escuela con el ID proporcionado no existe'], Response::HTTP_NOT_FOUND);
            }
        } else {
            $categoria_escuela = new CategoriaEscuela();
        }
        if (isset($data['nombre']) && $data['nombre'] !== '') {
            $categoria_escuela->setNombre(strtoupper($data['nombre']));
        } else {
            return $this->json(['error' => 9999, 'mensaje' => 'Falta el campo nombre']);
        }
        $entityManager->persist($categoria_escuela);
        $entityManager->flush();
        if (isset($data['id'])) {
            return $this->json(['error' => 0, 'mensaje' => 'Escuela actualizada correctamente', 'datos' => [$categoria_escuela]]);
        } else {
            return $this->json(['error' => 0, 'mensaje' => 'Escuela ingresado correctamente', 'datos' => [$categoria_escuela]]);
        }
    }

    #[Route('/categoria_escuela/{id<\d+>?}', name: 'consultarCategoriaEscuela', methods: ['GET'])]
    public function consultarCategoriaEscuela(?int $id, EntityManagerInterface $entityManager): Response
    {
        if ($id === null) {
            $categoria_escuela = $entityManager->getRepository(CategoriaEscuela::class)->findAll();
            return $this->json(['error' => 0, 'mensaje' => 'OK', 'datos' => $categoria_escuela]);
        }
        $categoria_escuela[0] = $entityManager->getRepository(CategoriaEscuela::class)->find($id);
        if (!$categoria_escuela) {
            return $this->json(['error' => 0, 'mensaje' => 'La categoria escuela con el ID proporcionado no existe']);
        }
        if ($categoria_escuela[0] == null)
            return $this->json(
                ['error' => 9999, 'mensaje' => 'No cuenta con datos']
            );
        return $this->json(['error' => 0, 'mensaje' => 'OK', 'datos' => $categoria_escuela]);
    }
    
   #[Route('/categoria_escuela_eliminar/{id<\d+>?}', name: 'eliminarCategoriaEscuela', methods: ['GET'])]
    public function eliminarCategoriaEscuela(?int $id, EntityManagerInterface $entityManager): Response
    {
        $categoria_escuela = $entityManager->getRepository(CategoriaEscuela::class)->find($id);
        if (!$categoria_escuela) {
            return $this->json(['error' => 9999, 'mensaje' => 'La escuela con el ID proporcionado no existe']);
        }
        $entityManager->remove($categoria_escuela);
        $entityManager->flush();
        return $this->json(['error' => 0, 'mensaje' => 'Eliminado correctamente']);
    }

}