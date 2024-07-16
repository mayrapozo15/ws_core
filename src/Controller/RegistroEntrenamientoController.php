<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Repository\RutinaDeportivasRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\RegistroEntrenamientoRepository;

class RegistroEntrenamientoController extends AbstractController
{
    
    private $rutinaDeportivasRepository;
    private $registroEntrenamientoRepository;

    public function __construct(RutinaDeportivasRepository $rutinaDeportivasRepository, RegistroEntrenamientoRepository $registroEntrenamientoRepository)
    {
        $this->registroEntrenamientoRepository = $registroEntrenamientoRepository;
        $this->rutinaDeportivasRepository = $rutinaDeportivasRepository;
    }

    #[Route('/registro_entrenamiento/{fecha_inicio}/{fecha_fin}', name: 'reporteRutinas', methods: ['GET'])]
    public function reporteRutinas(?\DateTime $fecha_inicio, ?\DateTime $fecha_fin): Response
    {
        if($fecha_inicio == '') return $this->json(['error' => 9999, 'mensaje' => 'Falta el campo fecha_inicio']);
        if($fecha_fin == '') return $this->json(['error' => 9999, 'mensaje' => 'Falta el campo fecha_fin']);
        $rutinas = $this->registroEntrenamientoRepository->findByDateRange($fecha_inicio, $fecha_fin);
        if(count($rutinas)> 0){
             $rutinasCompletas = (array)$this->rutinaDeportivasRepository->findAllRutinasCompletas();
            //  return $this->json(['error' => 0, 'mensaje' => 'Ok', 'datos' => $rutinas]);
            foreach ($rutinasCompletas as $key => $value) {
                $w_nume = 0;
                foreach ($rutinas as $keyr => $valuer) {
                    if ($value['id'] == $valuer['id_rutina']) {
                        $w_nume ++; 
                        $rutinasCompletas[$key]['fecha'] = $valuer['fecha'];
                        $rutinasCompletas[$key]['rutina_nombre'] = $valuer['rutina_nombre'];
                        $rutinasCompletas[$key]['jugador_nombres'] = $valuer['jugador_nombres'];
                        $rutinasCompletas[$key]['jugador_apellidos'] = $valuer['jugador_apellidos'];
                        $rutinasCompletas[$key]['escuela_nombre'] = $valuer['escuela_nombre'];
                    }
                }
                $rutinasCompletas[$key]['num_rutina'] = $w_nume;
            }
            $w_nuevos = [];
            return $this->json(['error' => 0, 'mensaje' => 'Ok', 'datos' => $rutinasCompletas]);
            foreach ($rutinasCompletas as $key => $value) {
                if(isset($value['num_rutina'])) array_push($w_nuevos,$value);
            }
            if(count($w_nuevos) > 0 )
            return $this->json(['error' => 0, 'mensaje' => 'Ok', 'datos' => $w_nuevos]);
        else return $this->json(['error' => 9999, 'mensaje' => 'Sin registro']);
        } else return $this->json(['error' => 9999, 'mensaje' => 'Sin registro']);
    }
}