<?php

namespace App\Entity;

use App\Repository\JugadoresTitulosRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: JugadoresTitulosRepository::class)]
class JugadoresTitulos
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $jugador = null;

    #[ORM\Column(length: 100)]
    private ?string $titulo = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getJugador(): ?int
    {
        return $this->jugador;
    }

    public function setJugador(int $jugador): static
    {
        $this->jugador = $jugador;

        return $this;
    }

    public function getTitulo(): ?string
    {
        return $this->titulo;
    }

    public function setTitulo(string $titulo): static
    {
        $this->titulo = $titulo;

        return $this;
    }
}
