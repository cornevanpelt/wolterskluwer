<?php

namespace App\Entity;

use App\Repository\BranchRepository;
use Doctrine\Common\Collections\Collection;
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

    #[ORM\OneToMany(mappedBy: 'branch', targetEntity: Order::class)]
    private $orders;

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

    /**
     * @return Collection<int, Order>
     */
    public function getOrders(): Collection
    {
        return $this->orders;
    }

    public function addOrder(Order $order): self
    {
        if (!$this->orders->contains($order)) {
            $this->orders[] = $order;
            $order->setStatus($this);
        }

        return $this;
    }

    public function removeOrder(Order $order): self
    {
        if ($this->orders->removeElement($order)) {
            // set the owning side to null (unless already changed)
            if ($order->getStatus() === $this) {
                $order->setStatus(null);
            }
        }

        return $this;
    }
}
