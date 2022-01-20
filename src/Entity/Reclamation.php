<?php

namespace App\Entity;

use App\Repository\ReclamationRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=ReclamationRepository::class)
 */
class Reclamation
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups("agent:read")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups("agent:read")
     */
    private $libelle;

    /**
     * @ORM\ManyToMany(targetEntity=AgentEtat::class, inversedBy="reclamations")
     */
    private $agent;

    public function __construct()
    {
        $this->agent = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLibelle(): ?string
    {
        return $this->libelle;
    }

    public function setLibelle(string $libelle): self
    {
        $this->libelle = $libelle;

        return $this;
    }

    /**
     * @return Collection|AgentEtat[]
     */
    public function getAgent(): Collection
    {
        return $this->agent;
    }

    public function addAgent(AgentEtat $agent): self
    {
        if (!$this->agent->contains($agent)) {
            $this->agent[] = $agent;
        }

        return $this;
    }

    public function removeAgent(AgentEtat $agent): self
    {
        $this->agent->removeElement($agent);

        return $this;
    }
}
