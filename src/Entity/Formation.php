<?php

namespace App\Entity;

use App\Repository\FormationRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: FormationRepository::class)]
class Formation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $Titre = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $sousTitre = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $detail = null;

    #[ORM\Column(length: 255)]
    private ?string $objectifs = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $contenu = null;

    #[ORM\Column(length: 30)]
    #[Assert\Choice(choices: ["presentiel", "en ligne"], message: "Choose a valid mode.")]
    private ?string $mode = null;

    #[ORM\Column(length: 30, nullable: true)]
    private ?string $duree = null;

    #[ORM\Column]
    private ?float $prixUnitaire = null;

    #[ORM\ManyToMany(targetEntity: Formateur::class, inversedBy: 'formations')]
    private Collection $formateurs;

    #[ORM\Column(length: 20, nullable: true)]
    #[Assert\Choice(choices: ["jour", "heure"], message: "Choose a valid unite.")]
    private ?string $unite = null;

    #[ORM\ManyToOne(inversedBy: 'formations')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Secteur $secteur = null;

    #[ORM\OneToMany(targetEntity: FormationAssuree::class, mappedBy: 'Formation')]
    private Collection $formationAssurees;

    public function __construct()
    {
        $this->formateurs = new ArrayCollection();
        $this->formationAssurees = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->Titre;
    }

    public function setTitre(string $Titre): static
    {
        $this->Titre = $Titre;

        return $this;
    }

    public function getSousTitre(): ?string
    {
        return $this->sousTitre;
    }

    public function setSousTitre(?string $sousTitre): static
    {
        $this->sousTitre = $sousTitre;

        return $this;
    }

    public function getDetail(): ?string
    {
        return $this->detail;
    }

    public function setDetail(?string $detail): static
    {
        $this->detail = $detail;

        return $this;
    }

    public function getObjectifs(): ?string
    {
        return $this->objectifs;
    }

    public function setObjectifs(string $objectifs): static
    {
        $this->objectifs = $objectifs;

        return $this;
    }

    public function getContenu(): ?string
    {
        return $this->contenu;
    }

    public function setContenu(?string $contenu): static
    {
        $this->contenu = $contenu;

        return $this;
    }

    public function getMode(): ?string
    {
        return $this->mode;
    }

    public function setMode(string $mode): static
    {
        $this->mode = $mode;

        return $this;
    }

    public function getDuree(): ?string
    {
        return $this->duree;
    }

    public function setDuree(?string $duree): static
    {
        $this->duree = $duree;

        return $this;
    }

    public function getPrixUnitaire(): ?float
    {
        return $this->prixUnitaire;
    }

    public function setPrixUnitaire(float $prixUnitaire): static
    {
        $this->prixUnitaire = $prixUnitaire;

        return $this;
    }

    /**
     * @return Collection<int, Formateur>
     */
    public function getFormateurs(): Collection
    {
        return $this->formateurs;
    }

    public function addFormateur(Formateur $formateur): static
    {
        if (!$this->formateurs->contains($formateur)) {
            $this->formateurs->add($formateur);
        }

        return $this;
    }

    public function removeFormateur(Formateur $formateur): static
    {
        $this->formateurs->removeElement($formateur);

        return $this;
    }

    public function getUnite(): ?string
    {
        return $this->unite;
    }

    public function setUnite(?string $unite): static
    {
        $this->unite = $unite;

        return $this;
    }

    public function getSecteur(): ?secteur
    {
        return $this->secteur;
    }

    public function setSecteur(?secteur $secteur): static
    {
        $this->secteur = $secteur;

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
            $formationAssuree->setFormation($this);
        }

        return $this;
    }

    public function removeFormationAssuree(FormationAssuree $formationAssuree): static
    {
        if ($this->formationAssurees->removeElement($formationAssuree)) {
            // set the owning side to null (unless already changed)
            if ($formationAssuree->getFormation() === $this) {
                $formationAssuree->setFormation(null);
            }
        }

        return $this;
    }
}
