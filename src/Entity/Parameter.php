<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ParameterRepository")
 */
class Parameter
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $GoogleAnalyticKey;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $GoogleReCaptchaKey;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $GoogleReCaptchaSecretKey;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $UrlDns;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $SiteName;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $AccountMailer;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $AccountMailerPassword;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getGoogleAnalyticKey(): ?string
    {
        return $this->GoogleAnalyticKey;
    }

    public function setGoogleAnalyticKey(?string $GoogleAnalyticKey): self
    {
        $this->GoogleAnalyticKey = $GoogleAnalyticKey;

        return $this;
    }

    public function getGoogleReCaptchaKey(): ?string
    {
        return $this->GoogleReCaptchaKey;
    }

    public function setGoogleReCaptchaKey(string $GoogleReCaptchaKey): self
    {
        $this->GoogleReCaptchaKey = $GoogleReCaptchaKey;

        return $this;
    }

    public function getGoogleReCaptchaSecretKey(): ?string
    {
        return $this->GoogleReCaptchaSecretKey;
    }

    public function setGoogleReCaptchaSecretKey(string $GoogleReCaptchaSecretKey): self
    {
        $this->GoogleReCaptchaSecretKey = $GoogleReCaptchaSecretKey;

        return $this;
    }

    public function getUrlDns(): ?string
    {
        return $this->UrlDns;
    }

    public function setUrlDns(string $UrlDns): self
    {
        $this->UrlDns = $UrlDns;

        return $this;
    }

    public function getSiteName(): ?string
    {
        return $this->SiteName;
    }

    public function setSiteName(string $SiteName): self
    {
        $this->SiteName = $SiteName;

        return $this;
    }

    public function getAccountMailer(): ?string
    {
        return $this->AccountMailer;
    }

    public function setAccountMailer(string $AccountMailer): self
    {
        $this->AccountMailer = $AccountMailer;

        return $this;
    }

    public function getAccountMailerPassword(): ?string
    {
        return $this->AccountMailerPassword;
    }

    public function setAccountMailerPassword(string $AccountMailerPassword): self
    {
        $this->AccountMailerPassword = $AccountMailerPassword;

        return $this;
    }
}
