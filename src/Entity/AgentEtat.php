<?php

namespace App\Entity;

use App\Repository\AgentEtatRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Serializer\Annotation\Groups;


/**
 * @ORM\Entity(repositoryClass=AgentEtatRepository::class)
 */
class AgentEtat
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @Groups("agent:read")
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=12)
     * @Groups("agent:read")
     */
    private $idAgent;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups("agent:read")
     * @Assert\NotBlank
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups("agent:read")
     * @Assert\NotBlank
     */
    private $prenom;

    /**
     * @ORM\Column(type="date")
     * @Groups("agent:read")
     * @Assert\NotBlank
     */
    private $datenaiss;

    /**
     * @ORM\Column(type="string", length=20)
     * @Groups("agent:read")
     * @Assert\NotBlank
     */
    private $matricule;

    /**
     * @ORM\Column(type="string", length=25, nullable=true)
     * @Groups("agent:read")
     * @Assert\NotBlank
     */
    private $cni;

    // /**
    //  * @ORM\Column(type="string", length=255, nullable=true)
    //  */
    // private $CNIname;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $reponse;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups("agent:read")
     * @Assert\NotBlank
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=25, nullable=true)
     * @Groups("agent:read")
     * @Assert\NotBlank
     */
    private $telephone;

    /**
     * @ORM\Column(type="text", nullable=true)
     * @Groups("agent:read")
     * @Assert\NotBlank
     */
    private $adresse;

    /**
     * @ORM\Column(type="text")
     * @Groups("agent:read")
     * @Assert\NotBlank
     */
    private $demande;

    /**
     * @ORM\Column(type="datetime")
     * @Assert\NotBlank
     */
    private $datedemande;

    /**
     * @ORM\Column(type="datetime",nullable=true)
     * @Assert\NotBlank
     */
    private $datetraitement;


    /**
     * @ORM\Column(type="string", length=255)
     * @Groups("agent:read")
     * @Assert\NotBlank
     */
    private $corps;

    /**
     * @ORM\ManyToMany(targetEntity=Reclamation::class, mappedBy="agent", cascade= "persist")
     * @Groups("agent:read")
     */
    private $reclamations;

    /**
     * @ORM\OneToMany(targetEntity=Image::class, mappedBy="piecesjointes",orphanRemoval=true, cascade={"persist"})
     */
    private $images;

    public function __construct()
    {
        $this->reclamations = new ArrayCollection();
        $this->images = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdAgent(): ?string
    {
        return $this->idAgent;
    }

    public function setIdAgent(string $idAgent): self
    {
        $this->idAgent = $idAgent;

        return $this;
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

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getDatenaiss(): ?\DateTimeInterface
    {
        return $this->datenaiss;
    }

    public function setDatenaiss(\DateTimeInterface $datenaiss): self
    {
        $this->datenaiss = $datenaiss;

        return $this;
    }

    public function getMatricule(): ?string
    {
        return $this->matricule;
    }

    public function setMatricule(string $matricule): self
    {
        $this->matricule = $matricule;

        return $this;
    }

    public function getCni(): ?string
    {
        return $this->cni;
    }

    public function setCni(?string $cni): self
    {
        $this->cni = $cni;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getTelephone(): ?string
    {
        return $this->telephone;
    }

    public function setTelephone(?string $telephone): self
    {
        $this->telephone = $telephone;

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(?string $adresse): self
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getDemande(): ?string
    {
        return $this->demande;
    }

    public function setDemande(string $demande): self
    {
        $this->demande = $demande;

        return $this;
    }

    public function getDatedemande(): ?\DateTimeInterface
    {
        return $this->datedemande;
    }

    public function setDatedemande(\DateTimeInterface $datedemande): self
    {
        $this->datedemande = $datedemande;

        return $this;
    }

    public function getCorps(): ?string
    {
        return $this->corps;
    }

    public function setCorps(string $corps): self
    {
        $this->corps = $corps;

        return $this;
    }

    /**
     * @return Collection|Reclamation[]
     */
    public function getReclamations(): Collection
    {
        return $this->reclamations;
    }

    public function addReclamation(Reclamation $reclamation): self
    {
        if (!$this->reclamations->contains($reclamation)) {
            $this->reclamations[] = $reclamation;
            $reclamation->addAgent($this);
        }

        return $this;
    }

    public function removeReclamation(Reclamation $reclamation): self
    {
        if ($this->reclamations->removeElement($reclamation)) {
            $reclamation->removeAgent($this);
        }

        return $this;
    }
    // public function getCNIname(): ?string
    // {
    //     return $this->CNIname;
    // }

    // public function setCNIname(?string $CNIname): self
    // {
    //     $this->CNIname = $CNIname;

    //     return $this;
    // }
    public function getReponse(): ?string
    {
        return $this->reponse;
    }

    public function setReponse(?string $reponse): self
    {
        $this->reponse = $reponse;

        return $this;
    }

    public function getDatetraitement(): ?\DateTimeInterface
    {
        return $this->datetraitement;
    }

    public function setDatetraitement(\DateTimeInterface $datetraitement): self
    {
        $this->datetraitement = $datetraitement;

        return $this;
    }

    /**
     * @return Collection|Image[]
     */
    public function getImages(): Collection
    {
        return $this->images;
    }

    public function addImage(Image $image): self
    {
        if (!$this->images->contains($image)) {
            $this->images[] = $image;
            $image->setPiecesjointes($this);
        }

        return $this;
    }

    public function removeImage(Image $image): self
    {
        if ($this->images->removeElement($image)) {
            // set the owning side to null (unless already changed)
            if ($image->getPiecesjointes() === $this) {
                $image->setPiecesjointes(null);
            }
        }

        return $this;
    }
}
