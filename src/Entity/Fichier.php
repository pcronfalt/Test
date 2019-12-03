<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\FichierRepository")
 */
class Fichier
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
private $nom;

/**
 * @ORM\Column(type="datetime", nullable=true)
 */
private $date;

/**
 * @ORM\Column(type="string", length=255, nullable=true)
 */
private $extension;

/**
 * @ORM\Column(type="float", nullable=true)
 */
private $taille;

public function getId(): ?int
{
return $this->id;
}

public function getNom(): ?string
{
return $this->nom;
}

public function setNom(?string $nom): self
{
$this->nom = $nom;

return $this;
}

public function getDate(): ?\DateTimeInterface
{
return $this->date;
}

public function setDate(?\DateTimeInterface $date): self
{
$this->date = $date;

return $this;
}

public function getExtension(): ?string
{
return $this->extension;
}

public function setExtension(?string $extension): self
{
$this->extension = $extension;

return $this;
}

public function getTaille(): ?float
{
return $this->taille;
}

public function setTaille(?float $taille): self
{
$this->taille = $taille;

return $this;
}

/**
 * @ORM\ManyToOne(targetEntity="App\Entity\Utilisateur", inversedBy="fichiers")
 */
private $utilisateur;

public function getUtilisateur(): ?Utilisateur
{
    return $this->utilisateur;
}

public function setUtilisateur(?Utilisateur $utilisateur): self
{
    $this->utilisateur = $utilisateur;

    return $this;
}

/**    
* 
* @ORM\ManyToMany(targetEntity="Theme")     
*/    
private $themes;

public function __construct()
{
    $this->themes = new ArrayCollection();
}

/**
 * @return Collection|Theme[]
 */
public function getThemes(): Collection
{
    return $this->themes;
}

public function addTheme(Theme $theme): self
{
    if (!$this->themes->contains($theme)) {
        $this->themes[] = $theme;
    }

    return $this;
}

public function removeTheme(Theme $theme): self
{
    if ($this->themes->contains($theme)) {
        $this->themes->removeElement($theme);
    }

    return $this;
}

}
