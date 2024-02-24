<?php

namespace App\Entity;

use App\Repository\FormateurRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FormateurRepository::class)]
class Formateur
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 30)]
    private ?string $name = null;

    #[ORM\Column(length: 50)]
    private ?string $firstname = null;

    #[ORM\Column(length: 100)]
    private ?string $adresse = null;

    #[ORM\Column(type: Types::BIGINT)]
    private ?string $cin = null;

    #[ORM\Column(length: 25)]
    private ?string $tel = null;

    #[ORM\Column(length: 50)]
    private ?string $email = null;

    #[ORM\Column(length: 255)]
    private ?string $specialite = null;



    #[ORM\OneToMany(targetEntity: FormationAssuree::class, mappedBy: 'formateur')]
    private Collection $formationAssurees;

    public function __construct()
    {
        $this->formationAssurees = new ArrayCollection();
    }



    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): static
    {
        $this->firstname = $firstname;

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

    public function getCin(): ?string
    {
        return $this->cin;
    }

    public function setCin(string $cin): static
    {
        $this->cin = $cin;

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

    public function getSpecialite(): ?string
    {
        return $this->specialite;
    }

    public function setSpecialite(string $specialite): static
    {
        $this->specialite = $specialite;

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
            $formationAssuree->setFormateur($this);
        }

        return $this;
    }

    public function removeFormationAssuree(FormationAssuree $formationAssuree): static
    {
        if ($this->formationAssurees->removeElement($formationAssuree)) {
            // set the owning side to null (unless already changed)
            if ($formationAssuree->getFormateur() === $this) {
                $formationAssuree->setFormateur(null);
            }
        }

        return $this;
    }

    public function __toString(): string
    {
        return $this->firstname.' '.$this->name;
    }


}
