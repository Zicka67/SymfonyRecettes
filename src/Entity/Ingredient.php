<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

//Pour charger les contraintes
use App\Repository\IngredientRepository;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

// use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: IngredientRepository::class)]
#[UniqueEntity('name')]
class Ingredient
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    //Pour appliquer les contraintes
    // #[Assert\NotBlank()]
    // #[Assert\length(min: 0, max: 200)]
    private ?string $name = null;

    #[ORM\Column]
    // #[Assert\NotNull()]
    // #[Assert\Positive()]
    // #[Assert\LessThan(200)]
    private ?float $price = null;

    #[ORM\Column]
    // #[Assert\NotNull()]
    private ?\DateTimeImmutable $createdAt = null;

    //Constructor
    public function __construct()
    {
        $this->createdAt = New \DateTimeImmutable();
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

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(float $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }
}