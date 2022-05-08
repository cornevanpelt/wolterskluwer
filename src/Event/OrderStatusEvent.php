<?php

declare(strict_types=1);

namespace App\Event;

use App\Entity\Order;
use Symfony\Contracts\EventDispatcher\Event;

class OrderStatusEvent extends Event
{
    public const NAME = 'orderstatus.updated';

    protected Order $order;

    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    public function getOrder(): Order
    {
        return $this->order;
    }
}