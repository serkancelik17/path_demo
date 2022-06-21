<?php

namespace App\Controller;

use App\Entity\Order;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class OrderController extends AbstractController
{
    /**
     * @Route("/api/orders", name="app_api_order")
     * @
     */
    public function index(): JsonResponse
    {
        $data = [];
        $user = $this->getUser();
        /** @var Order $order */
        foreach($user->getOrders() AS $order) {
            $data[] = [
                'orderCode' => $order->getOrderCode(),
                'productId' => $order->getProductId(),
                'quantity' => $order->getQuantity(),
                'address' => $order->getAddress(),
                'shippingDate' => $order->getShippingDate()->getTimestamp()
            ];
        }

        return $this->json($data);
    }
}
