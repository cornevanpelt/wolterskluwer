<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UserRepository::class)]
class User
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $name;

    #[ORM\OneToMany(mappedBy: 'user', targetEntity: Order::class, orphanRemoval: true)]
    private $orders;

    #[ORM\ManyToMany(targetEntity: UpdateMedium::class)]
    private $communicationPreference;

    public function __construct()
    {
        $this->orders = new ArrayCollection();
        $this->communicationPreference = new ArrayCollection();
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
            $order->setUser($this);
        }

        return $this;
    }

    public function removeOrder(Order $order): self
    {
        if ($this->orders->removeElement($order)) {
            // set the owning side to null (unless already changed)
            if ($order->getUser() === $this) {
                $order->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, UpdateMedium>
     */
    public function getCommunicationPreference(): Collection
    {
        return $this->communicationPreference;
    }

    public function addCommunicationPreference(UpdateMedium $communicationPreference): self
    {
        if (!$this->communicationPreference->contains($communicationPreference)) {
            $this->communicationPreference[] = $communicationPreference;
        }

        return $this;
    }

    public function removeCommunicationPreference(UpdateMedium $communicationPreference): self
    {
        $this->communicationPreference->removeElement($communicationPreference);

        return $this;
    }
}
