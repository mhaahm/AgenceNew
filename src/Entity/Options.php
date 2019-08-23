<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\OptionsRepository")
 */
class Options
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
     * @ORM\ManyToMany(targetEntity="App\Entity\Property", mappedBy="options")
     */
    private $propertys;

    public function __construct()
    {
        $this->propertys = new ArrayCollection();
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

    /**
     * @return Collection|Property[]
     */
    public function getPropertys(): Collection
    {
        return $this->propertys;
    }

    public function addProperty(Property $property): self
    {
        if (!$this->propertys->contains($property)) {
            $this->propertys[] = $property;
        }

        return $this;
    }

    public function removeProperty(Property $property): self
    {
        if ($this->propertys->contains($property)) {
            $this->propertys->removeElement($property);
        }

        return $this;
    }

    public function __toString()
    {
        return $this->name;
    }
}
