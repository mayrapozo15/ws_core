<?php

namespace App\Controller;

use App\Entity\JugadoresDestacados;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\JugadoresDestacadosRepository;
use App\Repository\RutinaDeportivasRepository;
class JugadoresDestacadosController extends AbstractController
{
    private $rutinaDeportivasRepository;
    public function __construct(RutinaDeportivasRepository $rutinaDeportivasRepository, EntityManagerInterface $entityManager, JugadoresDestacadosRepository $jugadoresDestacadosRepository)
    {
        $this->entityManager = $entityManager;
        $this->jugadoresDestacadosRepository = $jugadoresDestacadosRepository;
        $this->rutinaDeportivasRepository = $rutinaDeportivasRepository;
    }

    #[Route('/jugadores_destacados', name: 'crearJugadoresDestacados', methods: ['POST'])]
    public function crearJugadoresDestacados(Request $request): Response
    {
        $data = json_decode($request->getContent(), true);

        if (isset($data['id'])) {
            $jugadores_destacados = $this->jugadoresDestacadosRepository->findJugadorId($data['id']);
            if (!$jugadores_destacados) {
                return $this->json(["error" => 9999, 'mensaje' => 'El jugador destacado con el ID proporcionado no existe']);
            }
        } else {
            $jugadores_destacados = new JugadoresDestacados();
        }

        if (isset($data['categoria'])) {
            $jugadores_destacados->setCategoria($data['categoria']);
        }
        if (isset($data['nombres'])) {
            $jugadores_destacados->setNombres($data['nombres']);
        }
        if (isset($data['apellidos'])) {
            $jugadores_destacados->setApellidos($data['apellidos']);
        }
        if (isset($data['genero'])) {
            $jugadores_destacados->setGenero($data['genero']);
        }
        if (isset($data['estatura'])) {
            $jugadores_destacados->setEstatura($data['estatura']);
        }
        if (isset($data['peso'])) {
            $jugadores_destacados->setPeso($data['peso']);
        }
        if (isset($data['edad'])) {
            $jugadores_destacados->setEdad($data['edad']);
        }

        $this->entityManager->persist($jugadores_destacados);
        $this->entityManager->flush();

        if (isset($data['id'])) {
            return $this->json(['error' => 0, 'mensaje' => 'Jugador Destacado actualizado correctamente', 'datos' => [$jugadores_destacados]]);
        } else {
            return $this->json(['error' => 0, 'mensaje' => 'Jugador Destacado ingresado correctamente', 'datos' => $jugadores_destacados]);
        }
    }

    #[Route('/jugadores_destacados/{id<\d+>?}', name: 'consultarJugadoresDestacados', methods: ['GET'])]
    public function consultarJugadoresDestacados(?int $id, EntityManagerInterface $entityManager): Response
    {
        // return 'das';
        if ($id === null) {
            $jugadores_destacados = $entityManager->getRepository(JugadoresDestacados::class)->findAll();
            return $this->json(['error' => 0, 'mensaje' => 'OK', 'datos' => $jugadores_destacados]);
        }
        $jugadores_destacados[0] = $entityManager->getRepository(JugadoresDestacados::class)->find($id);
        if (!$jugadores_destacados) {
            return $this->json(['error' => 0, 'mensaje' => 'El Jugador Destacado con el ID proporcionado no existe']);
        }
        if ($jugadores_destacados[0] == null)
            return $this->json(
                ['error' => 9999, 'mensaje' => 'No cuenta con datos']
            );
        return $this->json(['error' => 0, 'mensaje' => 'OK', 'datos' => $jugadores_destacados]);
    }

    #[Route('/jugadores_destacados/{id}', name: 'eliminarJugadoresDestacados', methods: ['DELETE'])]
    public function eliminarJugadoresDestacados(int $id): Response
    {
        $rutinas = $this->rutinaDeportivasRepository->findAllRutinasPorJugador($id);

        if(count($rutinas) > 0){
            return $this->json(['error' => 9999, 'mensaje' => 'Jugador No se puede eliminar tiene rutinas']);
        }else{
            $jugadores_destacados = $this->jugadoresDestacadosRepository->findJugadorId($id);
            if (!$jugadores_destacados) {
                return $this->json(['error' => 9999, "mensaje" => 'El jugador destacado con el ID proporcionado no existe']);
            }
            $this->entityManager->remove($jugadores_destacados);
            $this->entityManager->flush();
            return $this->json(['error' => 0, 'mensaje' => 'Jugador destacado eliminado correctamente']);
        }

    }
}