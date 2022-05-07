<?php

namespace App\Contract;

use App\Entity\Branch;
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
     * Get all orders (all branches included)
     *
     * @return array
     */
    public function getOrders(): array;

    /**
     * Get all orders for given branch
     *
     * @param Branch $branch
     *
     * @return array|null
     */
    public function getOrdersByBranch(Branch $branch): ?array;

    /**
     * Get branch by branchId
     *
     * @param int $branchId
     *
     * @return Branch|null
     */
    public function getBranch(int $branchId): ?Branch;

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