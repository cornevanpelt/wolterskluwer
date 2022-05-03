<?php

namespace App\Entity;

use App\Repository\BranchRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BranchRepository::class)]
class Branch
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $name;

    #[ORM\Column(type: 'boolean')]
    private $hasDelivery;

    #[ORM\OneToOne(mappedBy: 'branch', targetEntity: Order::class, cascade: ['persist', 'remove'])]
    private $foodOrder;

    #[ORM\Column(type: 'boolean')]
    private $hasTakeaway;

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

    public function getHasDelivery(): ?bool
    {
        return $this->hasDelivery;
    }

    public function setHasDelivery(bool $hasDelivery): self
    {
        $this->hasDelivery = $hasDelivery;

        return $this;
    }

    public function getFoodOrder(): ?Order
    {
        return $this->foodOrder;
    }

    public function setFoodOrder(Order $foodOrder): self
    {
        // set the owning side of the relation if necessary
        if ($foodOrder->getBranch() !== $this) {
            $foodOrder->setBranch($this);
        }

        $this->foodOrder = $foodOrder;

        return $this;
    }

    public function getHasTakeaway(): ?bool
    {
        return $this->hasTakeaway;
    }

    public function setHasTakeaway(bool $hasTakeaway): self
    {
        $this->hasTakeaway = $hasTakeaway;

        return $this;
    }
}
