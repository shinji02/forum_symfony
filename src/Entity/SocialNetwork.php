<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\SocialNetworkRepository")
 */
class SocialNetwork
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255,nullable=true)
     */
    private $facebookPage;

    /**
     * @ORM\Column(type="string", length=255,nullable=true)
     */
    private $TwitterPage;

    /**
     * @ORM\Column(type="string", length=255,nullable=true)
     */
    private $InstragramPage;

    /**
     * @ORM\Column(type="string", length=255,nullable=true)
     */
    private $YoutubePage;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFacebookPage(): ?string
    {
        return $this->facebookPage;
    }

    public function setFacebookPage(string $facebookPage): self
    {
        $this->facebookPage = $facebookPage;

        return $this;
    }

    public function getTwitterPage(): ?string
    {
        return $this->TwitterPage;
    }

    public function setTwitterPage(string $TwitterPage): self
    {
        $this->TwitterPage = $TwitterPage;

        return $this;
    }

    public function getInstragramPage(): ?string
    {
        return $this->InstragramPage;
    }

    public function setInstragramPage(string $InstragramPage): self
    {
        $this->InstragramPage = $InstragramPage;

        return $this;
    }

    public function getYoutubePage(): ?string
    {
        return $this->YoutubePage;
    }

    public function setYoutubePage(string $YoutubePage): self
    {
        $this->YoutubePage = $YoutubePage;

        return $this;
    }
}
