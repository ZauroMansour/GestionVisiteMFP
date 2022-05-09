<?php

namespace App\Entity;

use App\Repository\FormationRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=FormationRepository::class)
 */
class Formation
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="Merci de renseigner votre prenom.")
     * @Assert\Length(
     *     min=2,
     *     max=50,
     * )
     */
    private $prenom;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="Merci de renseigner votre nom.")
     * @Assert\Length(
     *     min=2,
     *     max=25,
     * )
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=10)
     * @Assert\NotBlank(message="Merci de renseigner votre matricule.")
     * @Assert\Length(
     *      min = 7,
     *      max = 7,
<<<<<<< HEAD
     *      minMessage = "Veuillez revoir le format de votre matricule",
     *      maxMessage = "Veuillez revoir le format de votre matricule"
=======
     *      minMessage = "Veuillez revoir le format de votre matricule"
>>>>>>> fc5a89a0af00c8a02c4908636a64e4846b943988
     * )
     */
    private $matricule;

    /**
     * @ORM\Column(type="string", length=10)
     * @Assert\NotBlank(message="Merci de renseigner votre numero de telephone.")
     */
    private $telephone;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="Merci de renseigner votre email.")
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="Merci de renseigner votre fonction.")
     */
    private $formation;

    /**
     * @ORM\ManyToOne(targetEntity=Ministere::class, inversedBy="formations")
     * @Assert\NotBlank(message="Merci de renseigner votre ministere.")
     */
    private $ministere;

    /**
     * @ORM\ManyToMany(targetEntity=Thematique::class, inversedBy="formations")
     * @Assert\NotBlank(message="Merci de choisir au moin un thematique.")
     */
    private $thematique;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date_visite;

    public function __construct()
    {
        $this->thematique = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

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

    public function getFormation(): ?string
    {
        return $this->formation;
    }

    public function setFormation(string $formation): self
    {
        $this->formation = $formation;

        return $this;
    }

    public function getMinistere(): ?Ministere
    {
        return $this->ministere;
    }

    public function setMinistere(?Ministere $ministere): self
    {
        $this->ministere = $ministere;

        return $this;
    }

    /**
     * @return Collection|Thematique[]
     */
    public function getThematique(): Collection
    {
        return $this->thematique;
    }

    public function addThematique(Thematique $thematique): self
    {
        if (!$this->thematique->contains($thematique)) {
            $this->thematique[] = $thematique;
        }

        return $this;
    }

    public function removeThematique(Thematique $thematique): self
    {
        $this->thematique->removeElement($thematique);

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
}
