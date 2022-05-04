<?php

namespace App\Service;

use App\Contract\OrderServiceInterface;
use App\Entity\Order;
use App\Repository\BranchRepository;
use App\Repository\Contract\BottomRepositoryInterface;
use App\Repository\Contract\BranchRepositoryInterface;
use App\Repository\Contract\OrderStatusRepositoryInterface;
use App\Repository\Contract\ToppingRepositoryInterface;
use App\Repository\Contract\UpdateMediumRepositoryInterface;
use Doctrine\ORM\EntityManagerInterface;

class OrderService implements OrderServiceInterface
{
    private EntityManagerInterface $entityManager;
    private BranchRepository $branchRepository;
    private BottomRepositoryInterface $bottomRepository;
    private ToppingRepositoryInterface $toppingRepository;
    private OrderStatusRepositoryInterface $orderStatusRepository;
    private UpdateMediumRepositoryInterface $updateMediumRepository;

    public function __construct(
        EntityManagerInterface $entityManager,
        BranchRepositoryInterface $branchRepository,
        BottomRepositoryInterface $bottomRepository,
        ToppingRepositoryInterface $toppingRepository,
        OrderStatusRepositoryInterface $orderStatusRepository,
        UpdateMediumRepositoryInterface $updateMediumRepository
    ) {
        $this->entityManager = $entityManager;
        $this->branchRepository = $branchRepository;
        $this->bottomRepository = $bottomRepository;
        $this->toppingRepository = $toppingRepository;
        $this->orderStatusRepository = $orderStatusRepository;
        $this->updateMediumRepository = $updateMediumRepository;
    }

    /**
     * Bla bla bla
     *
     * @return string
     */
    public function test(): string
    {
        $em = $this->entityManager;

        $branch = $this->branchRepository->findOneBy(['name' => 'New York Pizza']);
        $bottom = $this->bottomRepository->findOneBy(['name' => 'Classic']);
        $topping = $this->toppingRepository->findOneBy(['name' => 'Hawaii']);
        $orderStatus = $this->orderStatusRepository->find(1);
        $updateMedium = $this->updateMediumRepository->findOneBy(['name' => 'SMS']);

        $order = new Order();
        $order->setBranch($branch);
        $order->setBottom($bottom);
        $order->setTopping($topping);
        $order->setStatus($orderStatus);
        $order->setUpdateMedium($updateMedium);

        dump($branch, $order);

        // tell Doctrine you want to (eventually) save the Product (no queries yet)
        $em->persist($order);

        // actually executes the queries (i.e. the INSERT query)
        $em->flush();

//        $myOrder = $em->find(Order::class, 1);
//        dump($myOrder);
//        dump($myOrder->getUpdateMedium()->getName());


        return 'werwwre';
    }
}