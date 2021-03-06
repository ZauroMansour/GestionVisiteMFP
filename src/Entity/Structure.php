<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\StructureRepository")
 */
class Structure
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nom;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\MotifDemande", mappedBy="structure")
     */
    private $motifDemandes;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Service", mappedBy="structure")
     */
    private $services;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Visite", mappedBy="structure")
     */
    private $visites;

    public function __construct()
    {
        $this->motifDemandes = new ArrayCollection();
        $this->services = new ArrayCollection();
        $this->visites = new ArrayCollection();
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
     * @return Collection|MotifDemande[]
     */
    public function getMotifDemandes(): Collection
    {
        return $this->motifDemandes;
    }

    public function addMotifDemande(MotifDemande $motifDemande): self
    {
        if (!$this->motifDemandes->contains($motifDemande)) {
            $this->motifDemandes[] = $motifDemande;
            $motifDemande->setStructure($this);
        }

        return $this;
    }

    public function removeMotifDemande(MotifDemande $motifDemande): self
    {
        if ($this->motifDemandes->contains($motifDemande)) {
            $this->motifDemandes->removeElement($motifDemande);
            // set the owning side to null (unless already changed)
            if ($motifDemande->getStructure() === $this) {
                $motifDemande->setStructure(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Service[]
     */
    public function getServices(): Collection
    {
        return $this->services;
    }

    public function addService(Service $service): self
    {
        if (!$this->services->contains($service)) {
            $this->services[] = $service;
            $service->setStructure($this);
        }

        return $this;
    }

    public function removeService(Service $service): self
    {
        if ($this->services->contains($service)) {
            $this->services->removeElement($service);
            // set the owning side to null (unless already changed)
            if ($service->getStructure() === $this) {
                $service->setStructure(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Visite[]
     */
    public function getVisites(): Collection
    {
        return $this->visites;
    }

    public function addVisite(Visite $visite): self
    {
        if (!$this->visites->contains($visite)) {
            $this->visites[] = $visite;
            $visite->setStructure($this);
        }

        return $this;
    }

    public function removeVisite(Visite $visite): self
    {
        if ($this->visites->contains($visite)) {
            $this->visites->removeElement($visite);
            // set the owning side to null (unless already changed)
            if ($visite->getStructure() === $this) {
                $visite->setStructure(null);
            }
        }

        return $this;
    }
}
