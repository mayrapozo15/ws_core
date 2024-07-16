<?php

namespace App\Controller;

use App\Entity\JugadoresTitulos;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class JugadoresTitulosController extends AbstractController
{
    #[Route('/jugadores_titulo', name: 'crearJugadoresTitulos', methods: ['POST'])]
    public function crearJugadoresTitulos(Request $request, EntityManagerInterface $entityManager): Response
    {
        $data = json_decode($request->getContent(), true);
        if (isset($data['id'])) {
            $jugadores_titulos = $entityManager->getRepository(JugadoresTitulos::class)->find($data['id']);
            if (!$jugadores_titulos) {
                return $this->json(['error' => 'La escuela con el ID proporcionado no existe'], Response::HTTP_NOT_FOUND);
            }
        } else {
            $jugadores_titulos = new JugadoresTitulos();
        }
        if (isset($data['jugador']) && $data['jugador'] !== '') {
            $jugadores_titulos->setJugador($data['jugador']);
        } else {
            return $this->json(['error' => 9999, 'mensaje' => 'Falta el campo jugador']);
        }
        if (isset($data['titulo']) && $data['titulo'] !== '') {
            $jugadores_titulos->setTitulo($data['titulo']);
        } else {
            return $this->json(['error' => 9999, 'mensaje' => 'Falta el campo titulo']);
        }
        $entityManager->persist($jugadores_titulos);
        $entityManager->flush();
        if (isset($data['id'])) {
            return $this->json(['error' => 0, 'mensaje' => 'Jugador Titulo actualizada correctamente', 'datos' => [$jugadores_titulos]]);
        } else {
            return $this->json(['error' => 0, 'mensaje' => 'Jugador Titulo ingresado correctamente', 'datos' => [$jugadores_titulos]]);
        }
    }

    #[Route('/jugadores_titulo/{id<\d+>?}', name: 'consultarJugadoresTitulos', methods: ['GET'])]
    public function consultarJugadoresTitulos(?int $id, EntityManagerInterface $entityManager): Response
    {
        if ($id === null) {
            $jugadores_titulos = $entityManager->getRepository(JugadoresTitulos::class)->findAll();
            return $this->json(['error' => 0, 'mensaje' => 'OK', 'datos' => $jugadores_titulos]);
        }
        $jugadores_titulos[0] = $entityManager->getRepository(JugadoresTitulos::class)->find($id);
        if (!$jugadores_titulos) {
            return $this->json(['error' => 0, 'mensaje' => 'El Jugador Titulo con el ID proporcionado no existe']);
        }
        if ($jugadores_titulos[0] == null)
            return $this->json(
                ['error' => 9999, 'mensaje' => 'No cuenta con datos']
            );
        return $this->json(['error' => 0, 'mensaje' => 'OK', 'datos' => $jugadores_titulos]);
    }
}