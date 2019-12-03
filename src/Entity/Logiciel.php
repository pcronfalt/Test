<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\LogicielRepository")
 */
class Logiciel
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
    private $nom;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $version;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Affecter", mappedBy="logiciel")
     */
    private $affecters;

    public function __construct()
    {
        $this->affecters = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getVersion(): ?string
    {
        return $this->version;
    }

    public function setVersion(string $version): self
    {
        $this->version = $version;

        return $this;
    }

    /**
     * @return Collection|Affecter[]
     */
    public function getAffecters(): Collection
    {
        return $this->affecters;
    }

    public function addAffecter(Affecter $affecter): self
    {
        if (!$this->affecters->contains($affecter)) {
            $this->affecters[] = $affecter;
            $affecter->setLogiciel($this);
        }

        return $this;
    }

    public function removeAffecter(Affecter $affecter): self
    {
        if ($this->affecters->contains($affecter)) {
            $this->affecters->removeElement($affecter);
            // set the owning side to null (unless already changed)
            if ($affecter->getLogiciel() === $this) {
                $affecter->setLogiciel(null);
            }
        }

        return $this;
    }
}
