<?php

namespace App\Controller;

use App\Repository\RutinaDeportivasRepository;
use App\Entity\RutinaDeportivas;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\JugadoresDestacadosRepository;
use App\Entity\JugadoresDestacados;

class RutinaDeportivasController extends AbstractController
{
    private $rutinaDeportivasRepository;
    private $entityManager;

    public function __construct(RutinaDeportivasRepository $rutinaDeportivasRepository, JugadoresDestacadosRepository $jugadoresDestacadosRepository, EntityManagerInterface $entityManager)
    {
        $this->rutinaDeportivasRepository = $rutinaDeportivasRepository;
        $this->jugadoresDestacadosRepository = $jugadoresDestacadosRepository;
        $this->entityManager = $entityManager;
    }

    #[Route('/rutinas_deportivas/{id<\d+>?}', name: 'consultarRutinasDeportivas', methods: ['GET'])]
    public function consultarRutinasDeportivas(?int $id): Response
    {
        if ($id !== null) {
            $rutinas = $this->rutinaDeportivasRepository->findAllRutinasPorJugador($id);
            if ($rutinas) {
                return $this->json(['error' => 0, 'mensaje' => 'OK', 'datos' => $rutinas]);
            }
            return $this->json(['error' => 9999, 'mensaje' => 'No cuenta con datos']);
        }else{
            $rutinas = $this->rutinaDeportivasRepository->findAllRutinasCompletas();
            if ($rutinas) {
                return $this->json(['error' => 0, 'mensaje' => 'OK', 'datos' => $rutinas]);
            }
            return $this->json(['error' => 9999, 'mensaje' => 'No cuenta con datos']);
        }
    }
    #[Route('/rutinas_deportivas', name: 'crearRutinaDeportiva', methods: ['POST'])]
    public function crearRutinaDeportiva(Request $request): Response
    {
         $data = json_decode($request->getContent(), true);
        if(!isset($data['jugador']))
            return $this->json(['error' => 9999, 'mensaje' => 'Falta el campo jugador']);
        if(isset($data['id'])){
            $rutina = $this->rutinaDeportivasRepository->findRutinasId($data['id']);
            //  return $this->json(['error' => 9999, 'mensaje' => 'Falta el campo jugador', "das"=> $rutina]);
            if (!$rutina) {
                return $this->json(['error' => 9999, 'mensaje' => 'Rutina no encontrada']);
            }else{
                if (!$rutina) {
                    return $this->json(['error' => 9999, 'mensaje' => 'Rutina no encontrada']);
                }
                if (isset($data['dia'])) {
                    $rutina->setDia($data['dia']);
                }
                if (isset($data['nombre'])) {
                    $rutina->setNombre($data['nombre']);
                }
                if (isset($data['repeticiones'])) {
                    $rutina->setRepeticiones($data['repeticiones']);
                }
                $this->entityManager->flush();
                $rutina = $this->rutinaDeportivasRepository->findRutinasId($data['id']);
                $w_rutina = [
                   "id" => $rutina->getId(),
                    "jugador" => $rutina->getJugador(),
                    "dia" => $rutina->getDia(),
                    "nombre" => $rutina->getNombre(),
                    "repeticiones" => $rutina->getRepeticiones(),
                ];
                return $this->json(['error' => 0, 'mensaje' => 'Actualizado', "datos"=> $w_rutina]);
            }
        }else{
            $jugadorDestacado = $this->entityManager->getRepository(JugadoresDestacados::class)->find($data['jugador']);
            if (!$jugadorDestacado) {
                return $this->json(['error' => 1001, 'mensaje' => 'Jugador no encontrado']);
            }
        
            $rutina = new RutinaDeportivas();
            $rutina->setJugador($data['jugador']);
            $rutina->setJugadorDestacado($jugadorDestacado);
            $rutina->setDia($data['dia']);
            $rutina->setNombre($data['nombre']);
            $rutina->setRepeticiones($data['repeticiones']);
            $this->entityManager->persist($rutina);
            $this->entityManager->flush();
            $w_rutina = [
                "id" => $rutina->getId(),
                 "jugador" => $rutina->getJugador(),
                 "dia" => $rutina->getDia(),
                 "nombre" => $rutina->getNombre(),
                 "repeticiones" => $rutina->getRepeticiones(),
             ];
            return $this->json(['error' => 0, 'mensaje' => 'Rutina creada correctamente', 'datos' => $w_rutina]);
        }
    }

    #[Route('/rutinas_deportivas/{id<\d+>}', name: 'eliminarRutinaDeportiva', methods: ['DELETE'])]
    public function eliminarRutinaDeportiva(int $id): Response
    {
        $rutina = $this->rutinaDeportivasRepository->findRutinasId($id);
        if (!$rutina) {
            return $this->json(['error' => 9999, 'mensaje' => 'Rutina no encontrada']);
        }
        $this->entityManager->remove($rutina);
        $this->entityManager->flush();
        return $this->json(['error' => 0, 'mensaje' => 'Rutina eliminada correctamente']);
    }
}
