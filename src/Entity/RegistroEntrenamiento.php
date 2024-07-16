<?php

namespace App\Entity;

use App\Repository\RegistroEntrenamientoRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RegistroEntrenamientoRepository::class)]
#[ORM\Table(name: "registro_entrenamiento")]
class RegistroEntrenamiento
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: "bigint", options: ["unsigned" => true])]
    private ?int $id = null;

    #[ORM\ManyToOne(targetEntity: Escuelas::class)]
    #[ORM\JoinColumn(name: "escuela", referencedColumnName: "id", nullable: true)]
    private ?Escuelas $escuela = null;

    #[ORM\ManyToOne(targetEntity: Alumnos::class)]
    #[ORM\JoinColumn(name: "alumno", referencedColumnName: "id", nullable: true)]
    private ?Alumnos $alumno = null;

    #[ORM\ManyToOne(targetEntity: RutinaDeportivas::class)]
    #[ORM\JoinColumn(name: "rutina", referencedColumnName: "id", nullable: true)]
    private ?RutinaDeportivas $rutina = null;

    #[ORM\Column(type: "date", nullable: true)]
    private ?\DateTimeInterface $fecha = null;

    // Getters y Setters

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

    public function getAlumno(): ?Alumnos
    {
        return $this->alumno;
    }

    public function setAlumno(?Alumnos $alumno): self
    {
        $this->alumno = $alumno;

        return $this;
    }

    public function getRutina(): ?RutinaDeportivas
    {
        return $this->rutina;
    }

    public function setRutina(?RutinaDeportivas $rutina): self
    {
        $this->rutina = $rutina;

        return $this;
    }

    public function getFecha(): ?\DateTimeInterface
    {
        return $this->fecha;
    }

    public function setFecha(?\DateTimeInterface $fecha): self
    {
        $this->fecha = $fecha;

        return $this;
    }

}