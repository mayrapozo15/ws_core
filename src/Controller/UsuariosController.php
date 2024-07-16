<?php

namespace App\Controller;

use App\Entity\Usuarios;
use App\Entity\Rol;
use App\Entity\Escuelas;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UsuariosController extends AbstractController
{
        
    #[Route('/usuario', name: 'crearUsuario', methods: ['POST'])]
    public function crearUsuario(Request $request, EntityManagerInterface $entityManager): Response
    {
        $data = json_decode($request->getContent(), true);
        if (isset($data['id'])) {
            $usuario = $entityManager->getRepository(Usuarios::class)->find($data['id']);
            if (!$usuario) {
                return $this->json(['error' => 'El usauriio con el ID proporcionado no existe'], Response::HTTP_NOT_FOUND);
            }
        } else {
            $usuario = new Usuarios();
        }
        if (isset($data['escuela']) && $data['escuela'] !== '') {
            $usuario->setEscuela($data['escuela']);
        } else {
            return $this->json(['error' => 9999, 'mensaje' => 'Falta el campo escuela']);
        }
        if (isset($data['usuario']) && $data['usuario'] !== '') {
            $usuario->setUsuario($data['usuario']);
        } else {
            return $this->json(['error' => 9999, 'mensaje' => 'Falta el campo usuario']);
        }
        if (isset($data['clave']) && $data['clave'] !== '') {
            $usuario->setClave($data['clave']);
        } else {
            return $this->json(['error' => 9999, 'mensaje' => 'Falta el campo clave']);
        }
        if (isset($data['nombres']) && $data['nombres'] !== '') {
            $usuario->setNombres(strtoupper($data['nombres']));
        } else {
            return $this->json(['error' => 9999, 'mensaje' => 'Falta el campo nombres']);
        }
        if (isset($data['rol']) && $data['rol'] !== '') {
            $usuario->setRol($data['rol']);
        } else {
            return $this->json(['error' => 9999, 'mensaje' => 'Falta el campo rol']);
        }
        $entityManager->persist($usuario);
        $entityManager->flush();
        if (isset($data['id'])) {
            return $this->consultarUsuario($data['id'], $entityManager);
        } else {
            return $this->json(['error' => 0, 'mensaje' => 'Ok', 'datos' => [$usuario]]);
        }
    }

    #[Route('/usuario/{id<\d+>?}', name: 'consultarUsuario', methods: ['GET'])]
    public function consultarUsuario(?int $id, EntityManagerInterface $entityManager): Response
    {
        $w_usuarios = [];
        if ($id === null) {
            $usuario = $entityManager->getRepository(Usuarios::class)->findAll();
            foreach ($usuario as $key => $value) {
                $w_escuelas = $entityManager->getRepository(Escuelas::class)->find($value->getEscuela());
                $w_roles = $entityManager->getRepository(Rol::class)->find($value->getRol());
                $w_aux = [
                    "id" => $value->getId(),
                    "escuela" => $value->getEscuela(),
                    "usuario" => $value->getUsuario(),
                    "clave" => $value->getClave(),
                    "nombres" => $value->getNombres(),
                    "rol" => $value->getRol(),
                    "rol_nombre" => $w_roles->getNombre(),
                    "escuela_nombre" => $w_escuelas->getNombre(),
                ];
                array_push($w_usuarios, $w_aux);
            }
            return $this->json(['error' => 0, 'mensaje' => 'OK', 'datos' => $w_usuarios]);
        }
        $usuario[0] = $entityManager->getRepository(Usuarios::class)->find($id);
       
        if (!$usuario) {
            return $this->json(['error' => 0, 'mensaje' => 'El Usuario con el ID proporcionado no existe']);
        }
        if ($usuario[0] == null)
            return $this->json(
                ['error' => 9999, 'mensaje' => 'No cuenta con datos']
            );
        $w_escuelas = $entityManager->getRepository(Escuelas::class)->find($usuario[0]->getEscuela());
        $w_roles = $entityManager->getRepository(Rol::class)->find($usuario[0]->getRol());
        $w_aux = [
            "id" => $usuario[0]->getId(),
            "escuela" => $usuario[0]->getEscuela(),
            "usuario" => $usuario[0]->getUsuario(),
            "clave" => $usuario[0]->getClave(),
            "nombres" => $usuario[0]->getNombres(),
            "rol" => $usuario[0]->getRol(),
            "rol_nombre" => $w_escuelas->getNombre(),
            "escuela_nombre" => $w_roles->getNombre(),
        ];
        array_push($w_usuarios, $w_aux);
        return $this->json(['error' => 0, 'mensaje' => 'OK', 'datos' => $w_usuarios]);
    }
    #[Route('/usuarioEliminar/{id<\d+>?}', name: 'eliminarUsuario', methods: ['GET'])]
    public function eliminarUsuario(?int $id, EntityManagerInterface $entityManager): Response
    {
        $usuario= $entityManager->getRepository(Usuarios::class)->find($id);
        if (!$usuario) {
            return $this->json(['error' => 0, 'mensaje' => 'El Usuario con el ID proporcionado no existe']);
        }
        $entityManager->remove($usuario);
        $entityManager->flush();
        return $this->json(['error' => 0, 'mensaje' => 'Eliminado correctamente']);
    }

    #[Route('/login/{user}/{clave}', name: 'login', methods: ['GET'])]
    public function login(?string $user, ?string $clave, EntityManagerInterface $entityManager): Response
    {
        $usuario[0] = $entityManager->getRepository(Usuarios::class)->findOneBy(['usuario' => $user]);
        if ($usuario[0] == null) {
            return $this->json(['error' => 9999, 'mensaje' => 'El usuario no existe']);
        }else{
            if($usuario[0]->getClave() == $clave){
                return $this->json(['error' => 0, 'mensaje' => 'OK', 'datos' => $usuario]);
            }else{
                return $this->json(['error' => 9999, 'mensaje' => 'Clave Incorrecta']);
            }
        }
    }
}