<?php

namespace App\Entity;

use App\Repository\VehiculeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=VehiculeRepository::class)
 */
class Vehicule
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
    private $immat;

    

    /**
     * @ORM\Column(type="text")
     */
    private $description;


    /**
     * @ORM\Column(type="string", length=255)
     */
    private $disponible = 1;

    /**
     * @ORM\OneToMany(targetEntity=Image::class, mappedBy="vehicule")
     */
    private $image;

    /**
     * @ORM\OneToMany(targetEntity=Location::class, mappedBy="vehicule")
     */
    private $location;

    /**
     * @ORM\ManyToOne(targetEntity=Categorie::class, inversedBy="vehicule")
     */
    private $categorie;

    /**
     * @ORM\ManyToMany(targetEntity=Couleur::class, inversedBy="vehicule")
     */
    private $couleurs;


    /**
     * @ORM\OneToMany(targetEntity=Model::class, mappedBy="vehicule")
     */
    private $model;

    /**
     * @ORM\ManyToMany(targetEntity=Marque::class, inversedBy="vehicule")
     */
    private $marque;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $prix;


  

    public function __construct()
    {
        $this->image = new ArrayCollection();
        $this->users = new ArrayCollection();
        $this->location = new ArrayCollection();
        $this->couleur = new ArrayCollection();
        $this->couleurs = new ArrayCollection();
        $this->model = new ArrayCollection();
        $this->marque = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getImmat(): ?string
    {
        return $this->immat;
    }

    public function setImmat(string $immat): self
    {
        $this->immat = $immat;

        return $this;
    }


    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getDisponible(): ?string
    {
        return $this->disponible;
    }

    public function setDisponible(string $disponible): self
    {
        $this->disponible = $disponible;

        return $this;
    }

    /**
     * @return Collection<int, Image>
     */
    public function getImage(): Collection
    {
        return $this->image;
    }

    public function addImage(Image $image): self
    {
        if (!$this->image->contains($image)) {
            $this->image[] = $image;
            $image->setVehicule($this);
        }

        return $this;
    }

    public function removeImage(Image $image): self
    {
        if ($this->image->removeElement($image)) {
            // set the owning side to null (unless already changed)
            if ($image->getVehicule() === $this) {
                $image->setVehicule(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Location>
     */
    public function getLocation(): Collection
    {
        return $this->location;
    }

    public function addLocation(Location $location): self
    {
        if (!$this->location->contains($location)) {
            $this->location[] = $location;
            $location->setVehicule($this);
        }

        return $this;
    }

    public function removeLocation(Location $location): self
    {
        if ($this->location->removeElement($location)) {
            // set the owning side to null (unless already changed)
            if ($location->getVehicule() === $this) {
                $location->setVehicule(null);
            }
        }

        return $this;
    }



    public function getCategorie(): ?Categorie
    {
        return $this->categorie;
    }

    public function setCategorie(?Categorie $categorie): self
    {
        $this->categorie = $categorie;

        return $this;
    }

    /**
     * @return Collection<int, Couleur>
     */
    public function getCouleurs(): Collection
    {
        return $this->couleurs;
    }

    public function addCouleur(Couleur $couleur): self
    {
        if (!$this->couleurs->contains($couleur)) {
            $this->couleurs[] = $couleur;
            $couleur->addVehicule($this);
        }

        return $this;
    }

    public function removeCouleur(Couleur $couleur): self
    {
        if ($this->couleurs->removeElement($couleur)) {
            $couleur->removeVehicule($this);
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
            $model->setVehicule($this);
        }

        return $this;
    }

    public function removeModel(Model $model): self
    {
        if ($this->model->removeElement($model)) {
            // set the owning side to null (unless already changed)
            if ($model->getVehicule() === $this) {
                $model->setVehicule(null);
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

    public function getPrix(): ?float
    {
        return $this->prix;
    }

    public function setPrix(?float $prix): self
    {
        $this->prix = $prix;

        return $this;
    }

    
}
