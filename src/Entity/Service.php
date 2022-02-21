<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ServiceRepository")
 */
class Service
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
     * @ORM\ManyToOne(targetEntity="App\Entity\Structure", inversedBy="services")
     * @ORM\JoinColumn(nullable=false)
     */
    private $structure;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\MotifDemande", mappedBy="service")
     */
    private $motifDemandes;

    /**
     * @ORM\Column(type="boolean")
     */
    private $agent;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\User", mappedBy="service")
     */
    private $users;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Visite", mappedBy="service")
     */
    private $visites;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Corps", mappedBy="service")
     */
    private $corps;

    public function __construct()
    {
        $this->motifDemandes = new ArrayCollection();
        $this->users = new ArrayCollection();
        $this->visites = new ArrayCollection();
        $this->corps = new ArrayCollection();
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

    public function getStructure(): ?Structure
    {
        return $this->structure;
    }

    public function setStructure(?Structure $structure): self
    {
        $this->structure = $structure;

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
            $motifDemande->setService($this);
        }

        return $this;
    }

    public function removeMotifDemande(MotifDemande $motifDemande): self
    {
        if ($this->motifDemandes->contains($motifDemande)) {
            $this->motifDemandes->removeElement($motifDemande);
            // set the owning side to null (unless already changed)
            if ($motifDemande->getService() === $this) {
                $motifDemande->setService(null);
            }
        }

        return $this;
    }

    public function getAgent(): ?bool
    {
        return $this->agent;
    }

    public function setAgent(bool $agent): self
    {
        $this->agent = $agent;

        return $this;
    }

    /**
     * @return Collection|User[]
     */
    public function getUsers(): Collection
    {
        return $this->users;
    }

    public function addUser(User $user): self
    {
        if (!$this->users->contains($user)) {
            $this->users[] = $user;
            $user->setService($this);
        }

        return $this;
    }

    public function removeUser(User $user): self
    {
        if ($this->users->contains($user)) {
            $this->users->removeElement($user);
            // set the owning side to null (unless already changed)
            if ($user->getService() === $this) {
                $user->setService(null);
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
            $visite->setService($this);
        }

        return $this;
    }

    public function removeVisite(Visite $visite): self
    {
        if ($this->visites->contains($visite)) {
            $this->visites->removeElement($visite);
            // set the owning side to null (unless already changed)
            if ($visite->getService() === $this) {
                $visite->setService(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        return $this->nom;
    }

    /**
     * @return Collection|Corps[]
     */
    public function getCorps(): Collection
    {
        return $this->corps;
    }

    public function addCorps(Corps $corps): self
    {
        if (!$this->corps->contains($corps)) {
            $this->corps[] = $corps;
            $corps->setService($this);
        }

        return $this;
    }

    public function removeCorps(Corps $corps): self
    {
        if ($this->corps->contains($corps)) {
            $this->corps->removeElement($corps);
            // set the owning side to null (unless already changed)
            if ($corps->getService() === $this) {
                $corps->setService(null);
            }
        }

        return $this;
    }
}

