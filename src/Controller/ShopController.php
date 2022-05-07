<?php

namespace App\Controller;

use App\Contract\OrderServiceInterface;
use App\Form\Model\Order;
use App\Form\OrderType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
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
    public function index(Request $request): Response
    {
        $order = new Order();
        $orderForm = $this->createForm(OrderType::class, $order);
        $orderForm->handleRequest($request);

        if ($orderForm->isSubmitted() && $orderForm->isValid()) {
            /** @var Order $order */
            $order = $orderForm->getData();

            if ($this->orderService->storeOrder($order)) {
                $this->addFlash('success', 'Uw bestelling is ontvangen!');
            } else {
                $this->addFlash('failure', 'Uw bestelling is helaas niet goed ontvangen...');
            }

            return $this->redirectToRoute('home');
        }

        return $this->render('shop/index.html.twig', [
            'form' => $orderForm->createView(),
            'orders' => $this->orderService->getOrders()
        ]);
    }
}
