<?php

namespace App\Controller;

use App\Entity\Rol;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RolController extends AbstractController
{
    #[Route('/rol', name: 'crearrol', methods: ['POST'])]
    public function crearrol(Request $request, EntityManagerInterface $entityManager): Response
    {
        $data = json_decode($request->getContent(), true);
        if (isset($data['id'])) {
            $rol = $entityManager->getRepository(Rol::class)->find($data['id']);
            if (!$rol) {
                return $this->json(['error' => 'La Rol con el ID proporcionado no existe'], Response::HTTP_NOT_FOUND);
            }
        } else {
            $rol = new Rol();
        }
        if (isset($data['nombre']) && $data['nombre'] !== '') {
            $rol->setNombre(strtoupper($data['nombre']));
        } else {
            return $this->json(['error' => 9999, 'mensaje' => 'Falta el campo nombre']);
        }
        $entityManager->persist($rol);
        $entityManager->flush();
        if (isset($data['id'])) {
            return $this->json(['error' => 0, 'mensaje' => 'Rol actualizada correctamente', 'datos' => [$rol]]);
        } else {
            return $this->json(['error' => 0, 'mensaje' => 'Rol creada correctamente', 'datos' => [$rol]]);
        }
    }

    #[Route('/rol/{id<\d+>?}', name: 'consultarRol', methods: ['GET'])]
    public function consultarRol(?int $id, EntityManagerInterface $entityManager): Response
    {
        if ($id === null) {
            $rol = $entityManager->getRepository(Rol::class)->findAll();
            return $this->json(['error' => 0, 'mensaje' => 'OK', 'datos' => $rol]);
        }
        $rol[0] = $entityManager->getRepository(Rol::class)->find($id);
        if (!$rol) {
            return $this->json(['error' => 0, 'mensaje' => 'La Rol con el ID proporcionado no existe']);
        }
        if ($rol[0] == null)
            return $this->json(
                ['error' => 9999, 'mensaje' => 'No cuenta con datos' ]
            );
        else
            return $this->json(['error' => 0, 'mensaje' => 'OK', 'datos' => $rol]);
    }
    #[Route('/rol/{id<\d+>?}', name: 'eliminarRol', methods: ['DELETE'])]
    public function eliminarRol(?int $id, EntityManagerInterface $entityManager): Response
    {
        $rol = $entityManager->getRepository(Rol::class)->find($id);
        if (!$rol) {
            return $this->json(['error' => 404, 'mensaje' => 'El rol con el ID proporcionado no existe']);
        }
        $entityManager->remove($rol);
        $entityManager->flush();
        return $this->json(['error' => 0, 'mensaje' => 'Eliminado correctamente']);
    }

    
}