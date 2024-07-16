<?php

namespace App\Entity;

use App\Repository\JugadoresDestacadosRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: JugadoresDestacadosRepository::class)]
class JugadoresDestacados
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $categoria = null;

    #[ORM\Column(length: 100)]
    private ?string $nombres = null;

    #[ORM\Column(length: 100)]
    private ?string $apellidos = null;

    #[ORM\Column(length: 100)]
    private ?string $genero = null;

    #[ORM\Column]
    private ?int $edad = null;
    
    #[ORM\Column]
    private ?float $estatura = null;
    
    #[ORM\Column]
    private ?float $peso = null;

   
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCategoria(): ?int
    {
        return $this->categoria;
    }

    public function setCategoria(?int $categoria): self
    {
        $this->categoria = $categoria;

        return $this;
    }

    public function getNombres(): ?string
    {
        return $this->nombres;
    }

    public function setNombres(?string $nombres): self
    {
        $this->nombres = $nombres;

        return $this;
    }

    public function getApellidos(): ?string
    {
        return $this->apellidos;
    }

    public function setApellidos(?string $apellidos): self
    {
        $this->apellidos = $apellidos;

        return $this;
    }

    public function getGenero(): ?string
    {
        return $this->genero;
    }

    public function setGenero(?string $genero): self
    {
        $this->genero = $genero;

        return $this;
    }

    public function getEstatura(): ?float
    {
        return $this->estatura;
    }

    public function setEstatura(?float $estatura): self
    {
        $this->estatura = $estatura;

        return $this;
    }

    public function getPeso(): ?float
    {
        return $this->peso;
    }

    public function setPeso(?float $peso): self
    {
        $this->peso = $peso;

        return $this;
    }

    public function getEdad(): ?int
    {
        return $this->edad;
    }

    public function setEdad(?int $edad): self
    {
        $this->edad = $edad;

        return $this;
    }
   

    
}
