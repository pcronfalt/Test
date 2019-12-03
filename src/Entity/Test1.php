<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\Test1Repository")
 */
class Test1
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
/**     * @ORM\ManyToOne(targetEntity="App\Entity\Test2", inversedBy="test1")     */    private $test2;
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

    public function getTest2(): ?Test2
    {
        return $this->test2;
    }

    public function setTest2(?Test2 $test2): self
    {
        $this->test2 = $test2;

        return $this;
    }
}
