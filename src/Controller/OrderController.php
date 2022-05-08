<?php

declare(strict_types=1);

namespace App\Controller;

use App\Contract\OrderServiceInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class OrderController extends AbstractController
{
    private OrderServiceInterface $orderService;

    public function __construct(OrderServiceInterface $orderService)
    {
        $this->orderService = $orderService;
    }

//    #[Route('/order/state', name: 'order_state', methods: ['PUT'])]
    #[Route('/order/state', name: 'order_state')]
    public function updateOrderState(Request $request)
    {
        $orderStateId = intval($request->get('orderStateId'));
        $orderId = intval($request->get('orderId'));

        $updateSuccess = $this->orderService->updateOrderState($orderId, $orderStateId);

        return new Response(strval($updateSuccess));
    }
}
