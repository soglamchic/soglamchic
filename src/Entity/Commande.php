<?php

namespace App\Entity;

use App\Repository\CommandeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CommandeRepository::class)]
class Commande
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\OneToMany(mappedBy: 'commande', targetEntity: CommandeDetail::class)]
    private $details;

    #[ORM\Column(type: 'date', nullable: true)]
    private $dateCommande;

    #[ORM\Column(type: 'date', nullable: true)]
    private $dateExpedition;

    #[ORM\Column(type: 'date', nullable: true)]
    private $dateReception;

    public function __construct()
    {
        $this->details = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection|CommandeDetail[]
     */
    public function getDetails(): Collection
    {
        return $this->details;
    }

    public function addDetail(CommandeDetail $detail): self
    {
        if (!$this->details->contains($detail)) {
            $this->details[] = $detail;
            $detail->setCommande($this);
        }

        return $this;
    }

    public function removeDetail(CommandeDetail $detail): self
    {
        if ($this->details->removeElement($detail)) {
            // set the owning side to null (unless already changed)
            if ($detail->getCommande() === $this) {
                $detail->setCommande(null);
            }
        }

        return $this;
    }

    public function getDateCommande(): ?\DateTimeInterface
    {
        return $this->dateCommande;
    }

    public function setDateCommande(?\DateTimeInterface $dateCommande): self
    {
        $this->dateCommande = $dateCommande;

        return $this;
    }

    public function getDateExpedition(): ?\DateTimeInterface
    {
        return $this->dateExpedition;
    }

    public function setDateExpedition(?\DateTimeInterface $dateExpedition): self
    {
        $this->dateExpedition = $dateExpedition;

        return $this;
    }

    public function getDateReception(): ?\DateTimeInterface
    {
        return $this->dateReception;
    }

    public function setDateReception(?\DateTimeInterface $dateReception): self
    {
        $this->dateReception = $dateReception;

        return $this;
    }
}
