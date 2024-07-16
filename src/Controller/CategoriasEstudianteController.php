<?php

namespace App\Controller;
use App\Entity\CategoriaEstudiante; 
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CategoriasEstudianteController extends AbstractController
{
    
    #[Route('/categoria_estudiante', name: 'crearCategoriaEstudiante', methods: ['POST'])]
    public function crearCategoriaEstudiante(Request $request, EntityManagerInterface $entityManager): Response
    {
        $data = json_decode($request->getContent(), true);
        if (isset($data['id'])) {
            $categoria_estudiante = $entityManager->getRepository(CategoriaEstudiante::class)->find($data['id']);
            if (!$categoria_estudiante) {
                return $this->json(['error' => 'La categoria estudiante con el ID proporcionado no existe'], Response::HTTP_NOT_FOUND);
            }
        } else {
            $categoria_estudiante = new CategoriaEstudiante();
        }
        if (isset($data['nombre']) && $data['nombre'] !== '') {
            $categoria_estudiante->setNombre(strtoupper($data['nombre']));
        } else {
            return $this->json(['error' => 9999, 'mensaje' => 'Falta el campo nombre']);
        }
        $entityManager->persist($categoria_estudiante);
        $entityManager->flush();
        if (isset($data['id'])) {
            return $this->json(['error' => 0, 'mensaje' => 'Escuela actualizada correctamente', 'datos' => [$categoria_estudiante]]);
        } else {
            return $this->json(['error' => 0, 'mensaje' => 'Escuela ingresado correctamente', 'datos' => [$categoria_estudiante]]);
        }
    }
    
}