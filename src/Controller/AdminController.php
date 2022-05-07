<?php

declare(strict_types = 1);

namespace App\Controller;

use App\Contract\OrderServiceInterface;
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

    #[Route('/admin/{branchId}', name: 'admin_home', requirements: ['branchId' => '\d+'])]
    public function index(Request $request, array $_route_params): Response
    {
        if (!is_null($branch = $this->orderService->getBranch(intval($_route_params['branchId'])))) {
            $orders = $this->orderService->getOrdersByBranch($branch);
            $orderStates = $this->orderService->getOrderStates();

            return $this->render('admin/index.html.twig', [
                'branchName' => $branch->getName(),
                'orders' => $orders,
                'states' => $orderStates
            ]);
        }

        return new Response('No branch found', Response::HTTP_NOT_FOUND);
    }
}
