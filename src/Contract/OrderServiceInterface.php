<?php

namespace App\Contract;

use App\Form\Model\Order;

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

    /**
     * Get all possible order states
     *
     * @return array
     */
    public function getOrderStates(): array;

    /**
     * @param int $orderId
     * @param int $orderState
     *
     * @return bool
     */
    public function updateOrderState(int $orderId, int $orderState): bool;
}