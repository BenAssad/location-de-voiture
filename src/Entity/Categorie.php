<?php

namespace App\Entity;

use App\Repository\CategorieRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CategorieRepository::class)
 */
class Categorie
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
    private $nom;
    // Register Magic Method to Print the name of the State e.g California
    public function __toString() {
        return $this->nom;
    }



 

    /**
     * @ORM\OneToMany(targetEntity=Model::class, mappedBy="categorie")
     */
    private $model;

    /**
     * @ORM\ManyToMany(targetEntity=Marque::class, inversedBy="categories")
     */
    private $marque;

    /**
     * @ORM\OneToMany(targetEntity=Vehicule::class, mappedBy="categorie")
     */
    private $vehicule;

    public function __construct()
    {
        $this->marque = new ArrayCollection();
        $this->model = new ArrayCollection();
        $this->vehicule = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    



    /**
     * @return Collection<int, Model>
     */
    public function getModel(): Collection
    {
        return $this->model;
    }

    public function addModel(Model $model): self
    {
        if (!$this->model->contains($model)) {
            $this->model[] = $model;
            $model->setCategorie($this);
        }

        return $this;
    }

    public function removeModel(Model $model): self
    {
        if ($this->model->removeElement($model)) {
            // set the owning side to null (unless already changed)
            if ($model->getCategorie() === $this) {
                $model->setCategorie(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Marque>
     */
    public function getMarque(): Collection
    {
        return $this->marque;
    }

    public function addMarque(Marque $marque): self
    {
        if (!$this->marque->contains($marque)) {
            $this->marque[] = $marque;
        }

        return $this;
    }

    public function removeMarque(Marque $marque): self
    {
        $this->marque->removeElement($marque);

        return $this;
    }

    /**
     * @return Collection<int, Vehicule>
     */
    public function getVehicule(): Collection
    {
        return $this->vehicule;
    }

    public function addVehicule(Vehicule $vehicule): self
    {
        if (!$this->vehicule->contains($vehicule)) {
            $this->vehicule[] = $vehicule;
            $vehicule->setCategorie($this);
        }

        return $this;
    }

    public function removeVehicule(Vehicule $vehicule): self
    {
        if ($this->vehicule->removeElement($vehicule)) {
            // set the owning side to null (unless already changed)
            if ($vehicule->getCategorie() === $this) {
                $vehicule->setCategorie(null);
            }
        }

        return $this;
    }
}
