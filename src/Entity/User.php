<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 */
class User
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
    private $prenom;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Affecter", mappedBy="user")
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

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

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
            $affecter->setUser($this);
        }

        return $this;
    }

    public function removeAffecter(Affecter $affecter): self
    {
        if ($this->affecters->contains($affecter)) {
            $this->affecters->removeElement($affecter);
            // set the owning side to null (unless already changed)
            if ($affecter->getUser() === $this) {
                $affecter->setUser(null);
            }
        }

        return $this;
    }
}
