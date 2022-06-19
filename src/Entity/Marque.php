<?php

namespace App\Entity;

use App\Repository\MarqueRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=MarqueRepository::class)
 */
class Marque
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
     * @ORM\ManyToMany(targetEntity=Categorie::class, mappedBy="marque")
     */
    private $categories;

    /**
     * @ORM\OneToMany(targetEntity=Model::class, mappedBy="marque")
     */
    private $model;

    /**
     * @ORM\ManyToMany(targetEntity=Vehicule::class, mappedBy="marque")
     */
    private $vehicule;



    public function __construct()
    {
        $this->categories = new ArrayCollection();
        $this->model = new ArrayCollection();
        $this->vehicules = new ArrayCollection();
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
     * @return Collection<int, Categorie>
     */
    public function getCategories(): Collection
    {
        return $this->categories;
    }

    public function addCategory(Categorie $category): self
    {
        if (!$this->categories->contains($category)) {
            $this->categories[] = $category;
            $category->addMarque($this);
        }

        return $this;
    }

    public function removeCategory(Categorie $category): self
    {
        if ($this->categories->removeElement($category)) {
            $category->removeMarque($this);
        }

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
            $model->setMarque($this);
        }

        return $this;
    }

    public function removeModel(Model $model): self
    {
        if ($this->model->removeElement($model)) {
            // set the owning side to null (unless already changed)
            if ($model->getMarque() === $this) {
                $model->setMarque(null);
            }
        }

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
            $vehicule->addMarque($this);
        }

        return $this;
    }

    public function removeVehicule(Vehicule $vehicule): self
    {
        if ($this->vehicule->removeElement($vehicule)) {
            $vehicule->removeMarque($this);
        }

        return $this;
    }




}
