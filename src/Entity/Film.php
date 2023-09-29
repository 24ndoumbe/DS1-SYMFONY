<?php

namespace App\Entity;

use App\Repository\FilmRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FilmRepository::class)]
class Film
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $titre = null;

    #[ORM\Column(length: 255)]
    private ?string $description = null;

    #[ORM\Column(length: 255)]
    private ?string $realisateur = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $date_sortie = null;

    #[ORM\Column]
    private ?int $durée = null;

    #[ORM\OneToMany(mappedBy: 'film', targetEntity: Projection::class)]
    private Collection $les_films;

    public function __construct()
    {
        $this->les_films = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): static
    {
        $this->titre = $titre;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getRealisateur(): ?string
    {
        return $this->realisateur;
    }

    public function setRealisateur(string $realisateur): static
    {
        $this->realisateur = $realisateur;

        return $this;
    }

    public function getDateSortie(): ?\DateTimeInterface
    {
        return $this->date_sortie;
    }

    public function setDateSortie(\DateTimeInterface $date_sortie): static
    {
        $this->date_sortie = $date_sortie;

        return $this;
    }

    public function getDurée(): ?int
    {
        return $this->durée;
    }

    public function setDurée(int $durée): static
    {
        $this->durée = $durée;

        return $this;
    }

    /**
     * @return Collection<int, Projection>
     */
    public function getLesFilms(): Collection
    {
        return $this->les_films;
    }

    public function addLesFilm(Projection $lesFilm): static
    {
        if (!$this->les_films->contains($lesFilm)) {
            $this->les_films->add($lesFilm);
            $lesFilm->setFilm($this);
        }

        return $this;
    }

    public function removeLesFilm(Projection $lesFilm): static
    {
        if ($this->les_films->removeElement($lesFilm)) {
            // set the owning side to null (unless already changed)
            if ($lesFilm->getFilm() === $this) {
                $lesFilm->setFilm(null);
            }
        }

        return $this;
    }
}
