<?php

namespace App\Controller;

use App\Contract\OrderServiceInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ShopController extends AbstractController
{
    private OrderServiceInterface $orderService;

    /**
     * @param OrderServiceInterface $orderService
     */
    public function __construct(OrderServiceInterface $orderService)
    {
        $this->orderService = $orderService;
    }

    #[Route('/', name: 'home')]
    public function index(): Response
    {
        dump($this->orderService->test());



        return $this->render('shop/index.html.twig', [
            'controller_name' => 'ShopController',
        ]);
    }

    #[Route('/order', name: 'place_order')]
    public function placeOrder(): Response
    {
        return $this->render('shop/index.html.twig', [
            'controller_name' => 'ShopController',
        ]);
    }

}
