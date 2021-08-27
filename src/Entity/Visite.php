<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\VisiteRepository")
 */
class Visite
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     * @Assert\NotBlank(message="Merci de renseigner votre nom.")
     * @Assert\Length(
     *     min=2,
     *     max=255,
     * )
     */
    private $nom_visiteur;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="Merci de renseigner votre prenom.")
     * @Assert\Length(
     *     min=2,
     *     max=255,
     * )
     */
    private $prenom_visiteur;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="Merci de renseigner votre adresse")
     */
    private $adresse;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date_visite;

    /**
     * @ORM\Column(type="text")
     * @Assert\NotBlank(message="Merci de rediger votre demande")
     */
    private $demande;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\MotifDemande", inversedBy="visites")
     * @ORM\JoinColumn(nullable=false)
     * @Assert\NotBlank(message="Merci de selectionner l'objet de votre demande")
     */
    private $motifDemande;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Departement", inversedBy="visites")
     * @ORM\JoinColumn(nullable=false)
     * @Assert\NotBlank(message="Merci de renseigner votre département")
     */
    private $departement;

    /**
     * @ORM\Column(type="string", length=100)
     * @Assert\NotBlank(message="Merci de renseigner votre numéro de téléphone")
     */
    private $telephone;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="Merci de renseigner votre adresse email")
     */
    private $email;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Region", inversedBy="visites")
     * @Assert\NotBlank(message="Merci de renseigner votre région de résidence")
     */
    private $region;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $matricule;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $profession;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $lieunaiss;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $cin;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $CNIname;

    /**
     * @ORM\Column(type="date")
     * @Assert\NotBlank(message="Merci de renseigner votre date de naissance")
     */
    private $datenaiss;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Service", inversedBy="visites")
     * @ORM\JoinColumn(nullable=false)
     */
    private $service;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Structure", inversedBy="visites")
     * @ORM\JoinColumn(nullable=false)
     */
    private $structure;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $reponse;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $genre;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomVisiteur(): ?string
    {
        return $this->nom_visiteur;
    }

    public function setNomVisiteur(string $nom_visiteur): self
    {
        $this->nom_visiteur = strtoupper($nom_visiteur);

        return $this;
    }

    public function getPrenomVisiteur(): ?string
    {
        return $this->prenom_visiteur;
    }

    public function setPrenomVisiteur(string $prenom_visiteur): self
    {
        $this->prenom_visiteur = strtoupper($prenom_visiteur);

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(string $adresse): self
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getDateVisite(): ?\DateTimeInterface
    {
        return $this->date_visite;
    }

    public function setDateVisite(\DateTimeInterface $date_visite): self
    {
        $this->date_visite = $date_visite;

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

    public function getMotifDemande(): ?MotifDemande
    {
        return $this->motifDemande;
    }

    public function setMotifDemande(?MotifDemande $motifDemande): self
    {
        $this->motifDemande = $motifDemande;

        return $this;
    }

    public function getDepartement(): ?Departement
    {
        return $this->departement;
    }

    public function setDepartement(?Departement $departement): self
    {
        $this->departement = $departement;

        return $this;
    }

    public function getTelephone(): ?string
    {
        return $this->telephone;
    }

    public function setTelephone(string $telephone): self
    {
        $this->telephone = $telephone;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getRegion(): ?Region
    {
        return $this->region;
    }

    public function setRegion(?Region $region): self
    {
        $this->region = $region;

        return $this;
    }

    public function getMatricule(): ?string
    {
        return $this->matricule;
    }

    public function setMatricule(?string $matricule): self
    {
        $this->matricule = $matricule;

        return $this;
    }

    public function getCin(): ?string
    {
        return $this->cin;
    }

    public function setCin(?string $cin): self
    {
        $this->cin = $cin;

        return $this;
    }

    public function getCNIname(): ?string
    {
        return $this->CNIname;
    }

    public function setCNIname(?string $CNIname): self
    {
        $this->CNIname = $CNIname;

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

    public function getService(): ?Service
    {
        return $this->service;
    }

    public function setService(?Service $service): self
    {
        $this->service = $service;

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

    public function getReponse(): ?string
    {
        return $this->reponse;
    }

    public function setReponse(?string $reponse): self
    {
        $this->reponse = $reponse;

        return $this;
    }

    public function getGenre(): ?string
    {
        return $this->genre;
    }

    public function setGenre(string $genre): self
    {
        $this->genre = $genre;

        return $this;
    }

    /**
     * Get the value of profession
     */ 
    public function getProfession()
    {
        return $this->profession;
    }

    /**
     * Set the value of profession
     *
     * @return  self
     */ 
    public function setProfession($profession)
    {
        $this->profession = $profession;

        return $this;
    }

    /**
     * Get the value of lieunaiss
     */ 
    public function getLieunaiss()
    {
        return $this->lieunaiss;
    }

    /**
     * Set the value of lieunaiss
     *
     * @return  self
     */ 
    public function setLieunaiss($lieunaiss)
    {
        $this->lieunaiss = strtoupper($lieunaiss);

        return $this;
    }
}
