<?php

namespace App\Entity;

use App\Repository\ImageRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ImageRepository::class)
 */
class Image
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $nomImg;

    /**
     * @ORM\ManyToOne(targetEntity=Vehicule::class, inversedBy="image", cascade={"persist"})
     */
    private $vehicule;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomImg(): ?string
    {
        return $this->nomImg;
    }

    public function setNomImg(?string $nomImg): self
    {
        $this->nomImg = $nomImg;

        return $this;
    }

    public function getVehicule(): ?Vehicule
    {
        return $this->vehicule;
    }

    public function setVehicule(?Vehicule $vehicule): self
    {
        $this->vehicule = $vehicule;

        return $this;
    }
}
