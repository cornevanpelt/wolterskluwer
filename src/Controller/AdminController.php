<?php

namespace App\Controller;

use App\Contract\OrderServiceInterface;
use App\Entity\Admin\AdminOrder;
use App\Entity\Admin\OrderOverview;
use App\Form\OrderOverviewType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractController
{
    private OrderServiceInterface $orderService;

    public function __construct(OrderServiceInterface $orderService)
    {
        $this->orderService = $orderService;
    }

    #[Route('/admin', name: 'admin_home')]
    public function index(Request $request): Response
    {
        $orders = $this->orderService->getOrders();
        $orderStates = $this->orderService->getOrderStates();

        return $this->render('admin/index.html.twig', [
            'orders' => $orders,
            'states' => $orderStates
        ]);
    }

    /**
     * Update state of given order
     */
    #[Route('/order/state', name: 'order_state')]
    public function updateOrderState(Request $request)
    {
        $orderStateId = $request->get('orderStateId');
        $orderId = $request->get('orderId');

        $updateSuccess = $this->orderService->updateOrderState($orderId, $orderStateId);

        return new Response($updateSuccess);
    }
}
