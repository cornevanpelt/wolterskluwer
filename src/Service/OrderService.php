<?php

namespace App\Service;

use App\Contract\OrderServiceInterface;
use App\Entity\Order as OrderEntity;
use App\Model\Order;
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
            $orderEntity->setBranch($order->getBranch());
            $orderEntity->setBottom($order->getBottom());
            $orderEntity->setTopping($order->getTopping());
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
        $orderEntities = $this->orderRepository->findAll();
        $orders = [];

        // map entities to domain model objects
        foreach ($orderEntities as $orderEntity) {
            $orders[] = Order::create($orderEntity->getBranch(), $orderEntity->getBottom(), $orderEntity->getTopping());
        }

        return $orders;
    }
}