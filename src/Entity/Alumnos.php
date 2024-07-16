<?php

namespace App\Entity;

use App\Repository\AlumnosRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AlumnosRepository::class)]
class Alumnos
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(targetEntity: Escuelas::class)]
    #[ORM\JoinColumn(name: "escuela", referencedColumnName: "id", nullable: true)]
    private ?Escuelas $escuela = null;

    #[ORM\Column]
    private ?int $categoria = null;

    #[ORM\Column(length: 10)]
    private ?string $cedula = null;

    #[ORM\Column(length: 50)]
    private ?string $nombres = null;

    #[ORM\Column(length: 50)]
    private ?string $apellidos = null;

    #[ORM\Column(length: 20)]
    private ?string $genero = null;

    #[ORM\Column]
    private ?float $estatura = null;

    #[ORM\Column]
    private ?float $peso = null;

    #[ORM\Column]
    private ?int $edad = null;

    public function getId(): ?int
    {
        return $this->id;
    }
public function getEscuela(): ?Escuelas
    {
        return $this->escuela;
    }

    public function setEscuela(?Escuelas $escuela): self
    {
        $this->escuela = $escuela;
        return $this;
    }
    public function getCategoria(): ?int
    {
        return $this->categoria;
    }

    public function setCategoria(int $categoria): static
    {
        $this->categoria = $categoria;

        return $this;
    }

    public function getCedula(): ?string
    {
        return $this->cedula;
    }

    public function setCedula(string $cedula): static
    {
        $this->cedula = $cedula;

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

    public function getApellidos(): ?string
    {
        return $this->apellidos;
    }

    public function setApellidos(string $apellidos): static
    {
        $this->apellidos = $apellidos;

        return $this;
    }

    public function getGenero(): ?string
    {
        return $this->genero;
    }

    public function setGenero(string $genero): static
    {
        $this->genero = $genero;

        return $this;
    }

    public function getEstatura(): ?float
    {
        return $this->estatura;
    }

    public function setEstatura(float $estatura): static
    {
        $this->estatura = $estatura;

        return $this;
    }

    public function getPeso(): ?float
    {
        return $this->peso;
    }

    public function setPeso(float $peso): static
    {
        $this->peso = $peso;

        return $this;
    }

    public function getEdad(): ?int
    {
        return $this->edad;
    }

    public function setEdad(int $edad): static
    {
        $this->edad = $edad;

        return $this;
    }
}