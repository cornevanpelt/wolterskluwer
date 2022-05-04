<?php

namespace App\Entity;

use App\Repository\OrderRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: OrderRepository::class)]
#[ORM\Table(name: '`order`')]
class Order
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\ManyToOne(targetEntity: Branch::class, inversedBy: 'orders')]
    #[ORM\JoinColumn(nullable: false)]
    private $branch;

    #[ORM\ManyToOne(targetEntity: Topping::class)]
    #[ORM\JoinColumn(nullable: false)]
    private $topping;

    #[ORM\ManyToOne(targetEntity: Bottom::class)]
    #[ORM\JoinColumn(nullable: false)]
    private $bottom;

    #[ORM\ManyToOne(targetEntity: OrderStatus::class, inversedBy: 'orders')]
    #[ORM\JoinColumn(nullable: false)]
    private $status;

    #[ORM\ManyToOne(targetEntity: UpdateMedium::class)]
    #[ORM\JoinColumn(nullable: false)]
    private $updateMedium;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getBranch(): ?Branch
    {
        return $this->branch;
    }

    public function setBranch(?Branch $branch): self
    {
        $this->branch = $branch;

        return $this;
    }

    public function getTopping(): ?Topping
    {
        return $this->topping;
    }

    public function setTopping(?Topping $topping): self
    {
        $this->topping = $topping;

        return $this;
    }

    public function getBottom(): ?Bottom
    {
        return $this->bottom;
    }

    public function setBottom(?Bottom $bottom): self
    {
        $this->bottom = $bottom;

        return $this;
    }

    public function getStatus(): ?OrderStatus
    {
        return $this->status;
    }

    public function setStatus(?OrderStatus $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getUpdateMedium(): ?UpdateMedium
    {
        return $this->updateMedium;
    }

    public function setUpdateMedium(?UpdateMedium $updateMedium): self
    {
        $this->updateMedium = $updateMedium;

        return $this;
    }
}
