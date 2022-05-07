<?php

namespace App\Service;

use App\Contract\OrderServiceInterface;
use App\Entity\Order as OrderEntity;
use App\Form\Model\Order;
use App\Repository\BranchRepository;
use App\Repository\Contract\BottomRepositoryInterface;
use App\Repository\Contract\BranchRepositoryInterface;
use App\Repository\Contract\OrderRepositoryInterface;
use App\Repository\Contract\OrderStatusRepositoryInterface;
use App\Repository\Contract\ToppingRepositoryInterface;
use App\Repository\Contract\UpdateMediumRepositoryInterface;
use Doctrine\ORM\EntityManagerInterface;
use Exception;

class OrderService implements OrderServiceInterface
{
    private EntityManagerInterface $entityManager;
    private BranchRepository $branchRepository;
    private BottomRepositoryInterface $bottomRepository;
    private ToppingRepositoryInterface $toppingRepository;
    private OrderStatusRepositoryInterface $orderStatusRepository;
    private UpdateMediumRepositoryInterface $updateMediumRepository;
    private OrderRepositoryInterface $orderRepository;

    public function __construct(
        EntityManagerInterface $entityManager,
        BranchRepositoryInterface $branchRepository,
        BottomRepositoryInterface $bottomRepository,
        ToppingRepositoryInterface $toppingRepository,
        OrderStatusRepositoryInterface $orderStatusRepository,
        UpdateMediumRepositoryInterface $updateMediumRepository,
        OrderRepositoryInterface $orderRepository
    ) {
        $this->entityManager = $entityManager;
        $this->branchRepository = $branchRepository;
        $this->bottomRepository = $bottomRepository;
        $this->toppingRepository = $toppingRepository;
        $this->orderStatusRepository = $orderStatusRepository;
        $this->updateMediumRepository = $updateMediumRepository;
        $this->orderRepository = $orderRepository;
    }

    /** {@inheritDoc} */
    public function storeOrder(Order $order): bool
    {
        $em = $this->entityManager;

        try {
            $orderStatus = $this->orderStatusRepository->find(1);
            $updateMedium = $this->updateMediumRepository->findOneBy(['name' => 'SMS']);

            $orderEntity = new OrderEntity();
            $orderEntity->setBranch($order->branch);
            $orderEntity->setBottom($order->bottom);
            $orderEntity->setTopping($order->topping);
            $orderEntity->setStatus($orderStatus);
            $orderEntity->setUpdateMedium($updateMedium);

            $em->persist($orderEntity);
            $em->flush();
        } catch (Exception $exception) {
            return false;
        }

        return true;
    }

    /** {@inheritDoc} */
    public function getOrders(): array
    {
        // get all order entities from (any) storage
        return $this->orderRepository->findAll();
    }

    /** {@inheritDoc} */
    public function getOrderStates(): array
    {
        return $this->orderStatusRepository->findAll();
    }

    /** {@inheritDoc} */
    public function updateOrderState(int $orderId, int $orderState): bool
    {
        try {
            $orderState = $this->orderStatusRepository->find($orderState);
            $order = $this->orderRepository->find($orderId);
            $order->setStatus($orderState);

            $this->entityManager->flush();
        } catch (Exception $exception) {
            return false;
        }

        return true;
    }
}