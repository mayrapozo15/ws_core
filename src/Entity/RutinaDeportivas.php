<?php

namespace App\Entity;

use App\Repository\RutinaDeportivasRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RutinaDeportivasRepository::class)]
class RutinaDeportivas
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'bigint')]
    private $id;

    #[ORM\Column(type: 'bigint', nullable: true)]
    private $jugador;

    #[ORM\Column(type: 'string', length: 50, nullable: true)]
    private $dia;

    #[ORM\Column(type: 'string', length: 50, nullable: true)]
    private $nombre;

    #[ORM\Column(type: 'string', length: 50, nullable: true)]
    private $repeticiones;

    #[ORM\ManyToOne(targetEntity: JugadoresDestacados::class)]
    #[ORM\JoinColumn(name: "jugador", referencedColumnName: "id", nullable: true)]
    private $jugadorDestacado;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getJugador(): ?int
    {
        return $this->jugador;
    }

    public function setJugador(?int $jugador): self
    {
        $this->jugador = $jugador;

        return $this;
    }

    public function getDia(): ?string
    {
        return $this->dia;
    }

    public function setDia(?string $dia): self
    {
        $this->dia = $dia;

        return $this;
    }

    public function getNombre(): ?string
    {
        return $this->nombre;
    }

    public function setNombre(?string $nombre): self
    {
        $this->nombre = $nombre;

        return $this;
    }

    public function getRepeticiones(): ?string
    {
        return $this->repeticiones;
    }

    public function setRepeticiones(?string $repeticiones): self
    {
        $this->repeticiones = $repeticiones;

        return $this;
    }

    public function getJugadorDestacado(): ?JugadoresDestacados
    {
        return $this->jugadorDestacado;
    }

    public function setJugadorDestacado(?JugadoresDestacados $jugadorDestacado): self
    {
        $this->jugadorDestacado = $jugadorDestacado;

        return $this;
    }
}
