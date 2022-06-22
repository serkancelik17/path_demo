<?php

namespace App\Controller;

use App\Entity\Order;
use App\Repository\OrderRepository;
use DateTime;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class OrderController extends AbstractController
{
    /** @var EntityManager */
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * List all Orders
     * @Route("/api/orders", name="api_orders_index", methods={"GET"})
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

    /**
     * Show an order
     * @Route("/api/orders/{order}", name="api_orders_show", methods={"GET"})
     * @return JsonResponse
     * @throws \Exception
     */
    public function show(Order $order)
    {
        $data = [];

        $user = $this->getUser();

        //Check is correct user
        if ($user->getId() !== $order->getUser()->getId())
            throw new \Exception("This order is not yours!");

        $data = [
            'orderCode' => $order->getOrderCode(),
            'productId' => $order->getProductId(),
            'quantity' => $order->getQuantity(),
            'address' => $order->getAddress(),
            'shippingDate' => $order->getShippingDate()->getTimestamp()
        ];


        return $this->json($data);
    }

    /**
     * Create new order
     * @Route("/api/orders", name="api_orders_store", methods={"POST"})
     * @param Request $request
     * @param ValidatorInterface $validator
     * @return JsonResponse
     */
    public function store(Request $request, ValidatorInterface $validator): JsonResponse
    {
        try {
            $user = $this->getUser();

            $params = json_decode($request->getContent(), true);
            $shippingDate = new \DateTime('@'.strtotime($params['shippingDate']));

            if($this->entityManager->getRepository(Order::class)->findOneBy(['orderCode'=>$params['orderCode']]))
                throw new \Exception($params['orderCode'].' already created!');

            $order = new Order();
            $order->setOrderCode($params['orderCode'])->setProductId($params['productId'])
                ->setQuantity($params['quantity'])->setAddress($params['address'])
                ->setShippingDate($shippingDate);

            /** @TODO will change with relation $user->addOrder */
            $order->setUser($user);

            $errors = $validator->validate($order);
            if (count($errors) > 0) {
                throw new \Exception('Order not valid! Make sure all field is filled.');
            }

            $this->entityManager->persist($order);
            $this->entityManager->flush();

            return $this->json(['success' => true, 'message' => 'Order created!']);

        } catch (\Exception $e) {
            return $this->json(['success' => false,'message'=>$e->getMessage()]);
        }
    }

    /**
     * Update an order
     * @Route("/api/orders/{order}", name="api_orders_update", methods={"PUT"})
     * @param Request $request
     * @param Order $order
     * @return JsonResponse
     */
    public function update(Request $request,Order $order)
    {
        try {
            $this->entityManager = $this->getDoctrine()->getManager();
            $user = $this->getUser();
            $params = json_decode($request->getContent(), true);

            //Check is correct user
            if ($user->getId() !== $order->getUser()->getId())
                throw new \Exception("This order is not yours!");

            if($order->getShippingDate() < new DateTime("now") )
                throw new \Exception("You cannot update this order because its shipping date has passed!");


            //hydrate to params
            $order->fromArray($params);

            $this->entityManager->persist($order);
            $this->entityManager->flush();

            return $this->json(['success' => true,'message'=>'Order updated.']);

        } catch (\Exception $e) {
            return $this->json(['success' => false, 'message' => $e->getMessage()]);
        }
    }
}
