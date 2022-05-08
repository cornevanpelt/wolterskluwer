<?php

namespace App\Tests;

use App\Entity\Branch;
use App\Repository\Contract\BottomRepositoryInterface;
use App\Repository\Contract\BranchRepositoryInterface;
use App\Repository\Contract\OrderRepositoryInterface;
use App\Repository\Contract\OrderStatusRepositoryInterface;
use App\Repository\Contract\ToppingRepositoryInterface;
use App\Repository\Contract\UpdateMediumRepositoryInterface;
use App\Repository\Contract\UserRepositoryInterface;
use App\Service\OrderService;
use Doctrine\ORM\EntityManagerInterface;
use PHPUnit\Framework\TestCase;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

class OrderServiceTest extends TestCase
{
    public function testGetBranch()
    {
        $branch = new Branch();
        $branch
            ->setName('Dominos')
            ->setHasDelivery(true)
            ->setHasTakeaway(false);

        // Now, mock the repository so it returns the mock of the employee
        $entityManagerRepository = $this->createMock(EntityManagerInterface::class);
        $branchRepository = $this->createMock(BranchRepositoryInterface::class);
        $bottomRepository = $this->createMock(BottomRepositoryInterface::class);
        $toppingRepository = $this->createMock(ToppingRepositoryInterface::class);
        $orderStatusRepository = $this->createMock(OrderStatusRepositoryInterface::class);
        $updateMediumRepository = $this->createMock(UpdateMediumRepositoryInterface::class);
        $userRepository = $this->createMock(UserRepositoryInterface::class);
        $orderRepository = $this->createMock(OrderRepositoryInterface::class);
        $eventDispatcher = $this->createMock(EventDispatcherInterface::class);

        $branchRepository->expects($this->any())
            ->method('find')
            ->willReturn($branch);

        $orderService = new OrderService(
            $entityManagerRepository,
            $branchRepository,
            $bottomRepository,
            $toppingRepository,
            $orderStatusRepository,
            $updateMediumRepository,
            $userRepository,
            $orderRepository,
            $eventDispatcher
        );

        $this->assertEquals('Dominos', $orderService->getBranch(1)->getName());
        $this->assertEquals(true, $orderService->getBranch(1)->getHasDelivery());
        $this->assertEquals(false, $orderService->getBranch(1)->getHasTakeaway());
    }
}
