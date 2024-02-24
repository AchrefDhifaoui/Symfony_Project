<?php

namespace App\Entity;

use App\Repository\ClientRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ClientRepository::class)]
class Client
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column(length: 255)]
    private ?string $adresse = null;

    #[ORM\Column(length: 25)]
    private ?string $tel = null;

    #[ORM\Column(length: 50)]
    private ?string $email = null;

    #[ORM\Column(length: 20)]
    private ?string $mf = null;

    #[ORM\OneToMany(targetEntity: FormationAssuree::class, mappedBy: 'client')]
    private Collection $formationAssurees;

    public function __construct()
    {
        $this->formationAssurees = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): static
    {
        $this->nom = $nom;

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(string $adresse): static
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getTel(): ?string
    {
        return $this->tel;
    }

    public function setTel(string $tel): static
    {
        $this->tel = $tel;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    public function getMf(): ?string
    {
        return $this->mf;
    }

    public function setMf(string $mf): static
    {
        $this->mf = $mf;

        return $this;
    }

    /**
     * @return Collection<int, FormationAssuree>
     */
    public function getFormationAssurees(): Collection
    {
        return $this->formationAssurees;
    }

    public function addFormationAssuree(FormationAssuree $formationAssuree): static
    {
        if (!$this->formationAssurees->contains($formationAssuree)) {
            $this->formationAssurees->add($formationAssuree);
            $formationAssuree->setClient($this);
        }

        return $this;
    }

    public function removeFormationAssuree(FormationAssuree $formationAssuree): static
    {
        if ($this->formationAssurees->removeElement($formationAssuree)) {
            // set the owning side to null (unless already changed)
            if ($formationAssuree->getClient() === $this) {
                $formationAssuree->setClient(null);
            }
        }

        return $this;
    }
}
