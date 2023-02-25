<?php

namespace App\Controller;

use App\Repository\CategoryRepository;
use App\Repository\OrderDetailRepository;
use App\Repository\OrderRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class OrderController extends AbstractController
{
    /**
     * @Route("/order", name="app_order")
     */
    public function showBillAction(OrderRepository $repo, CategoryRepository $brand, OrderDetailRepository $repo1, UserRepository $user): Response
        {
            $user = $this->getUser();
            $data[]=[
                    'id'=>$user->getId()
            ];
            $id = $data[0]['id'];
            $br = $brand->findAll();
            $order = $repo->findAll();
            $od = $repo1->abc($id);
            return $this->render('order/index.html.twig', [
                'order' => $order,
                'brand' => $br,
                'od' => $od,
            ]);
        }


         /**
         * @Route("/receipt", name="app_receipt")
         */
        public function manageReceipt(OrderRepository $order, OrderDetailRepository $repo, UserRepository $user, Request $req): Response
        {

            // $userinfo = $user->findAll();
            // $oid = $order->findorderid()
            $odt = $repo->managerReceipt('id');
        
            // $od = $repo->managerReceipt();
            // $od = $repo1->managerReceipt($value);
            return $this->render('order/receipt.html.twig', [
                // 'order' => $order,
                'odt' => $odt,
            ]);
        }
}
