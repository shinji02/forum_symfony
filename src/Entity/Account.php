<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AccountRepository")
 * @UniqueEntity(fields={"email"}, message="There is already an account with this email")
 */
class Account implements UserInterface
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     */
    private $email;

    /**
     * @ORM\Column(type="json")
     */
    private $roles = [];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=255,unique=true)
     */
    private $username;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createAt;

    /**
     * @ORM\Column(type="string", length=25, nullable=true)
     */
    private $keyPass;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isActive;

    /**
     * @ORM\Column(type="string", length=25)
     */
    private $keyCreateAccountValidator;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Subjec", mappedBy="auhor")
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

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUsername(): string
    {
        return (string) $this->username;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getPassword(): string
    {
        return (string) $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getSalt()
    {
        // not needed when using the "bcrypt" algorithm in security.yaml
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

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

    public function getKeyPass(): ?string
    {
        return $this->keyPass;
    }

    public function setKeyPass(?string $keyPass): self
    {
        $this->keyPass = $keyPass;

        return $this;
    }

    public function getIsActive(): ?bool
    {
        return $this->isActive;
    }

    public function setIsActive(bool $isActive): self
    {
        $this->isActive = $isActive;

        return $this;
    }

    public function getKeyCreateAccountValidator(): ?string
    {
        return $this->keyCreateAccountValidator;
    }

    public function setKeyCreateAccountValidator(string $keyCreateAccountValidator): self
    {
        $this->keyCreateAccountValidator = $keyCreateAccountValidator;

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
            $subjec->setAuhor($this);
        }

        return $this;
    }

    public function removeSubjec(Subjec $subjec): self
    {
        if ($this->subjecs->contains($subjec)) {
            $this->subjecs->removeElement($subjec);
            // set the owning side to null (unless already changed)
            if ($subjec->getAuhor() === $this) {
                $subjec->setAuhor(null);
            }
        }

        return $this;
    }
}
