<?php

namespace App\Contract;

use App\Model\Order;

interface OrderServiceInterface
{
    /**
     * Store the order
     *
     * @param Order $orderEntity
     *
     * @return bool
     */
    public function storeOrder(Order $orderEntity): bool;

    /**
     * Get all orders
     *
     * @return array
     */
    public function getOrders(): array;
}