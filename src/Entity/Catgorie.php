<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CatgorieRepository")
 * @UniqueEntity("name")
 */
class Catgorie
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     *
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Color;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Icon;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $pos;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Subjec", mappedBy="categorie")
     */
    private $subjecs;

    public function __construct()
    {
        $this->subjecs = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getColor(): ?string
    {
        return $this->Color;
    }

    public function setColor(string $Color): self
    {
        $this->Color = $Color;

        return $this;
    }

    public function getIcon(): ?string
    {
        return $this->Icon;
    }

    public function setIcon(string $Icon): self
    {
        $this->Icon = $Icon;

        return $this;
    }

    public function getPos(): ?string
    {
        return $this->pos;
    }

    public function setPos(string $pos): self
    {
        $this->pos = $pos;

        return $this;
    }

    /**
     * @return Collection|Subjec[]
     */
    public function getSubjecs(): Collection
    {
        return $this->subjecs;
    }

    public function addSubjec(Subjec $subjec): self
    {
        if (!$this->subjecs->contains($subjec)) {
            $this->subjecs[] = $subjec;
            $subjec->setCategorie($this);
        }

        return $this;
    }

    public function removeSubjec(Subjec $subjec): self
    {
        if ($this->subjecs->contains($subjec)) {
            $this->subjecs->removeElement($subjec);
            // set the owning side to null (unless already changed)
            if ($subjec->getCategorie() === $this) {
                $subjec->setCategorie(null);
            }
        }

        return $this;
    }
}
