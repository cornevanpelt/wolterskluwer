<?php

namespace App\Form\Model;

use App\Entity\Bottom;
use App\Entity\Branch;
use App\Entity\Topping;
use Symfony\Component\Validator\Constraints as Assert;

class Order
{
    #[Assert\NotBlank]
    public ?Branch $branch;

    #[Assert\NotBlank]
    public ?Bottom $bottom;

    #[Assert\NotBlank]
    public ?Topping $topping;
}
