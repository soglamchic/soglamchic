<?php

namespace App\Entity;

use App\Repository\CommendeRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CommendeRepository::class)]
class Commende
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'commendes')]
    private $acheteur;

    #[ORM\Column(type: 'string', length: 45, nullable: true)]
    private $reference;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAcheteur(): ?User
    {
        return $this->acheteur;
    }

    public function setAcheteur(?User $acheteur): self
    {
        $this->acheteur = $acheteur;

        return $this;
    }

    public function getReference(): ?string
    {
        return $this->reference;
    }

    public function setReference(?string $reference): self
    {
        $this->reference = $reference;

        return $this;
    }
}
