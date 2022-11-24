<?php

namespace App\Entity;

use App\Repository\JuguetesRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=JuguetesRepository::class)
 */
class Juguetes
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nombre;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $marca;

    /**
     * @ORM\ManyToOne(targetEntity=PublicoObjetivo::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $publicoObjetivo;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNombre(): ?string
    {
        return $this->nombre;
    }

    public function setNombre(string $nombre): self
    {
        $this->nombre = $nombre;

        return $this;
    }

    public function getMarca(): ?string
    {
        return $this->marca;
    }

    public function setMarca(string $marca): self
    {
        $this->marca = $marca;

        return $this;
    }

    public function getPublicoObjetivo(): ?PublicoObjetivo
    {
        return $this->publicoObjetivo;
    }

    public function setPublicoObjetivo(?PublicoObjetivo $publicoObjetivo): self
    {
        $this->publicoObjetivo = $publicoObjetivo;

        return $this;
    }
}
