<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AffecterRepository")
 */
class Affecter
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
    private $licence;

    /**
     * @ORM\Column(type="integer")
     */
    private $nb;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="affecters")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Logiciel", inversedBy="affecters")
     * @ORM\JoinColumn(nullable=false)
     */
    private $logiciel;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLicence(): ?string
    {
        return $this->licence;
    }

    public function setLicence(string $licence): self
    {
        $this->licence = $licence;

        return $this;
    }

    public function getNb(): ?int
    {
        return $this->nb;
    }

    public function setNb(int $nb): self
    {
        $this->nb = $nb;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getLogiciel(): ?Logiciel
    {
        return $this->logiciel;
    }

    public function setLogiciel(?Logiciel $logiciel): self
    {
        $this->logiciel = $logiciel;

        return $this;
    }
}
