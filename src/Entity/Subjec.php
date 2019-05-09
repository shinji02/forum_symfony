<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\SubjecRepository")
 */
class Subjec
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
    private $name;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Catgorie", inversedBy="subjecs")
     */
    private $categorie;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Account", inversedBy="subjecs")
     */
    private $auhor;

    /**
     * @ORM\Column(type="integer")
     */
    private $nbView;

    /**
     * @ORM\Column(type="text")
     */
    private $fileSystem;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createAt;

    /**
     * @ORM\Column(type="text")
     */
    private $body;

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

    public function getCategorie(): ?Catgorie
    {
        return $this->categorie;
    }

    public function setCategorie(?Catgorie $categorie): self
    {
        $this->categorie = $categorie;

        return $this;
    }

    public function getAuhor(): ?Account
    {
        return $this->auhor;
    }

    public function setAuhor(?Account $auhor): self
    {
        $this->auhor = $auhor;

        return $this;
    }

    public function getNbView(): ?int
    {
        return $this->nbView;
    }

    public function setNbView(int $nbView): self
    {
        $this->nbView = $nbView;

        return $this;
    }

    public function getFileSystem(): ?string
    {
        return $this->fileSystem;
    }

    public function setFileSystem(string $fileSystem): self
    {
        $this->fileSystem = $fileSystem;

        return $this;
    }

    public function getCreateAt(): ?\DateTimeInterface
    {
        return $this->createAt;
    }

    public function setCreateAt(\DateTimeInterface $createAt): self
    {
        $this->createAt = $createAt;

        return $this;
    }

    public function getBody(): ?string
    {
        return $this->body;
    }

    public function setBody(string $body): self
    {
        $this->body = $body;

        return $this;
    }
}
