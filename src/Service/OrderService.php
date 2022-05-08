<?php

declare(strict_types=1);

namespace App\Service;

use App\Contract\OrderServiceInterface;
use App\Entity\Branch;
use App\Entity\Order as OrderEntity;
use App\Event\OrderStatusEvent;
use App\Form\Model\Order;
use App\Repository\BranchRepository;
use App\Repository\Contract\BottomRepositoryInterface;
use App\Repository\Contract\BranchRepositoryInterface;
use App\Repository\Contract\OrderRepositoryInterface;
use App\Repository\Contract\OrderStatusRepositoryInterface;
use App\Repository\Contract\ToppingRepositoryInterface;
use App\Repository\Contract\UpdateMediumRepositoryInterface;
use App\Repository\Contract\UserRepositoryInterface;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

class OrderService implements OrderServiceInterface
{
    private EntityManagerInterface $entityManager;
    private BranchRepository $branchRepository;
    private BottomRepositoryInterface $bottomRepository;
    private ToppingRepositoryInterface $toppingRepository;
    private OrderStatusRepositoryInterface $orderStatusRepository;
    private UpdateMediumRepositoryInterface $updateMediumRepository;
    private UserRepositoryInterface $userRepository;
    private OrderRepositoryInterface $orderRepository;
    private EventDispatcherInterface $eventDispatcher;

    public function __construct(
        EntityManagerInterface $entityManager,
        BranchRepositoryInterface $branchRepository,
        BottomRepositoryInterface $bottomRepository,
        ToppingRepositoryInterface $toppingRepository,
        OrderStatusRepositoryInterface $orderStatusRepository,
        UpdateMediumRepositoryInterface $updateMediumRepository,
        UserRepositoryInterface $userRepository,
        OrderRepositoryInterface $orderRepository,
        EventDispatcherInterface $eventDispatcher
    ) {
        $this->entityManager = $entityManager;
        $this->branchRepository = $branchRepository;
        $this->bottomRepository = $bottomRepository;
        $this->toppingRepository = $toppingRepository;
        $this->orderStatusRepository = $orderStatusRepository;
        $this->updateMediumRepository = $updateMediumRepository;
        $this->userRepository = $userRepository;
        $this->orderRepository = $orderRepository;
        $this->eventDispatcher = $eventDispatcher;
    }

    /** {@inheritDoc} */
    public function storeOrder(Order $order): bool
    {
        $em = $this->entityManager;

        try {
            // TODO: obviously normally this user is not hard-coded but managed by the authentication system
            $user = $this->userRepository->find(1);
            $orderStatus = $this->orderStatusRepository->find(1);
            $updateMedium = $this->updateMediumRepository->findOneBy(['name' => 'SMS']);

            $orderEntity = new OrderEntity();
            $orderEntity->setBranch($order->branch);
            $orderEntity->setBottom($order->bottom);
            $orderEntity->setTopping($order->topping);
            $orderEntity->setStatus($orderStatus);
            $orderEntity->setUser($user);

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
    public function getOrdersByBranch(Branch $branch): ?array
    {
        $qb = ($this->entityManager->createQueryBuilder())
            ->select('o')
            ->from(OrderEntity::class, 'o')
            ->where('o.branch = ?1')
            ->setParameters([1 => $branch]);

        $ordersByBranch = $qb->getQuery()->getResult();

        return is_array($ordersByBranch) ? $ordersByBranch : null;
    }

    /** {@inheritDoc} */
    public function getBranch(int $branchId): ?Branch
    {
        return $this->branchRepository->find($branchId);
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
            $this->dispatchOrderStatusEvent($order);
        } catch (Exception $exception) {
            return false;
        }

        return true;
    }

    /**
     * Dispatch OrderStatusEvent to indicate order status has changed
     *
     * @return void
     */
    private function dispatchOrderStatusEvent(OrderEntity $order): void
    {
        $event = new OrderStatusEvent($order);

        $this->eventDispatcher->dispatch($event, OrderStatusEvent::NAME);
    }
}