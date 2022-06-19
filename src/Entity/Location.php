<?php

namespace App\Entity;

use App\Repository\LocationRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=LocationRepository::class)
 */
class Location
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime_immutable")
     */
    private $empruntAt;

    /**
     * @ORM\Column(type="datetime_immutable")
     */
    private $renduAt;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="location")
     */
    private $user;

    /**
     * @ORM\ManyToOne(targetEntity=Vehicule::class, inversedBy="location")
     */
    private $vehicule;

    /**
     * @ORM\Column(type="binary")
     */
    private $rendu;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $lieulocation;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $lieurendu;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $prolongation;



   

    public function __construct()
    {
        $this->users = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmpruntAt(): ?\DateTimeImmutable
    {
        return $this->empruntAt;
    }

    public function setEmpruntAt(\DateTimeImmutable $empruntAt): self
    {
        $this->empruntAt = $empruntAt;

        return $this;
    }

    public function getRenduAt(): ?\DateTimeImmutable
    {
        return $this->renduAt;
    }

    public function setRenduAt(\DateTimeImmutable $renduAt): self
    {
        $this->renduAt = $renduAt;

        return $this;
    }

    /**
     * @return Collection<int, User>
     */
    public function getUsers(): Collection
    {
        return $this->users;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

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

    public function getRendu()
    {
        return $this->rendu;
    }

    public function setRendu($rendu): self
    {
        $this->rendu = $rendu;

        return $this;
    }

    public function getLieulocation(): ?string
    {
        return $this->lieulocation;
    }

    public function setLieulocation(string $lieulocation): self
    {
        $this->lieulocation = $lieulocation;

        return $this;
    }

    public function getLieurendu(): ?string
    {
        return $this->lieurendu;
    }

    public function setLieurendu(string $lieurendu): self
    {
        $this->lieurendu = $lieurendu;

        return $this;
    }

    public function getProlongation(): ?\DateTimeInterface
    {
        return $this->prolongation;
    }

    public function setProlongation(?\DateTimeInterface $prolongation): self
    {
        $this->prolongation = $prolongation;

        return $this;
    }




}
