<?php

namespace App\Entity;

use App\Repository\UsuariosRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UsuariosRepository::class)]
class Usuarios
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $escuela = null;

    #[ORM\Column(length: 10)]
    private ?string $usuario = null;

    #[ORM\Column(length: 10)]
    private ?string $clave = null;

    #[ORM\Column(length: 50)]
    private ?string $nombres = null;

    #[ORM\Column]
    private ?int $rol = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEscuela(): ?int
    {
        return $this->escuela;
    }

    public function setEscuela(int $escuela): static
    {
        $this->escuela = $escuela;

        return $this;
    }

    public function getUsuario(): ?string
    {
        return $this->usuario;
    }

    public function setUsuario(string $usuario): static
    {
        $this->usuario = $usuario;

        return $this;
    }

    public function getClave(): ?string
    {
        return $this->clave;
    }

    public function setClave(string $clave): static
    {
        $this->clave = $clave;

        return $this;
    }

    public function getNombres(): ?string
    {
        return $this->nombres;
    }

    public function setNombres(string $nombres): static
    {
        $this->nombres = $nombres;

        return $this;
    }

    public function getRol(): ?int
    {
        return $this->rol;
    }

    public function setRol(int $rol): static
    {
        $this->rol = $rol;

        return $this;
    }
}