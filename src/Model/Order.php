<?php

namespace App\Model;

use App\Entity\Bottom;
use App\Entity\Branch;
use App\Entity\Topping;
use Symfony\Component\Validator\Constraints as Assert;

class Order
{
    #[Assert\NotBlank]
    private ?Branch $branch;

    #[Assert\NotBlank]
    private ?Bottom $bottom;

    #[Assert\NotBlank]
    private ?Topping $topping;

    public function __construct(?Branch $branch = null, ?Bottom $bottom = null, ?Topping $topping = null)
    {
        $this->branch = $branch;
        $this->bottom = $bottom;
        $this->topping = $topping;
    }

    /**
     * Create an Order
     *
     * @param Branch $branch
     * @param Bottom $bottom
     * @param Topping $topping
     *
     * @return Order
     */
    public static function create(Branch $branch, Bottom $bottom, Topping $topping)
    {
        return new self($branch, $bottom, $topping);
    }

    /**
     * @return Branch|null
     */
    public function getBranch(): ?Branch
    {
        return $this->branch;
    }

    /**
     * @param Branch|null $branch
     * @return Order
     */
    public function setBranch(?Branch $branch): Order
    {
        $this->branch = $branch;

        return $this;
    }

    /**
     * @return Bottom|null
     */
    public function getBottom(): ?Bottom
    {
        return $this->bottom;
    }

    /**
     * @param Bottom|null $bottom
     * @return Order
     */
    public function setBottom(?Bottom $bottom): Order
    {
        $this->bottom = $bottom;

        return $this;
    }

    /**
     * @return Topping|null
     */
    public function getTopping(): ?Topping
    {
        return $this->topping;
    }

    /**
     * @param Topping|null $topping
     * @return Order
     */
    public function setTopping(?Topping $topping): Order
    {
        $this->topping = $topping;

        return $this;
    }
}
