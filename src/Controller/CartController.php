<?php

namespace App\Controller;

use App\Entity\Cart;
use App\Entity\Order;
use App\Entity\OrderDetail;
use App\Entity\Product;
use App\Entity\User;
use App\Repository\CartRepository;
use App\Repository\CategoryRepository;
use App\Repository\OrderDetailRepository;
use App\Repository\OrderRepository;
use App\Repository\ProductRepository;
use App\Repository\UserRepository;
use Doctrine\DBAL\Schema\Exception\ForeignKeyDoesNotExist;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
date_default_timezone_set('Asia/Ho_Chi_Minh');

class CartController extends AbstractController
{
   
    
      /**
     * @Route("/addcart/{id}", name="app_addcart")
     */
    public function addOneAction(CartRepository $repo, Product $pro, CategoryRepository $brand, Request $req ): Response
    {   
        // $user = $this->get('security.context')->getToken()->getUser();
        // $userId = $user->getId();
        
        $quantity = $req->query->get('quantity');
        $BR = $brand->findAll();
        
        $user = $this->getUser();
        $data[]=[
            'id'=>$user->getId()
        ];
       $id = $data[0]['id'];
        //check pro id exist with $userId
        $carts = $repo->findBy([
               'product'=>$pro->getId(),
            'user'=>$id
             ]);
            //  return $this->json(count($carts));
        //if null
        if (count($carts)==0){
             $cart = new Cart();
            $cart->setProduct($pro);
            $cart->setQuantity($quantity);
            // $cart->setbirthday(new \DateTime());
            $cart->setUser($user);

        }
       
        else {
            
            $cart = $repo->find($carts[0]->getId()); // a Cart 
            $oldquantity = $cart->getQuantity();
            $newquantity = $oldquantity + $quantity;
            $cart->setquantity($newquantity);
        }
        $repo->add($cart,true);
        // return $this->json($cart);
        return $this->redirectToRoute('cart', [
            'brand' => $BR, 'pro'=>$cart
        ], Response::HTTP_SEE_OTHER);
       
    }
    /**
     * @Route("/cart", name="cart")
     */
    public function cartt(CategoryRepository $brand ,CartRepository $repo): Response
    {
        $user = $this->getUser();
        $data[]=[
            'id'=>$user->getId()
            // 'name'=>$user->getname(),
            // 'email'=>$user->getUsername()
        ];
       $id = $data[0]['id'];
        // return $this->json($repo->cart($id));
        $cart = $repo->cart($id);
        $BR = $brand->findAll();
        // $cart = $reCart->findAll();
        $user = $this->getUser();
        $data[]=[
            'id'=>$user->getId()
        ];
        $uid = $data[0]['id'];
        $product = $repo->cart($uid);
        $totalAll = 0;
        foreach ($product as $p) {
            $totalAll += $p['total'];
        }
       
        return $this->render('cart/index.html.twig', [
            'pro'=>$cart, 'brand' => $BR, 'total'=>$totalAll
        ]);
    }

    
     /**
     * @Route("/delete/cart/{id}",name="cart_delete",requirements={"id"="\d+"})
     */
     public function deletecart(CartRepository $repo, Cart $c): Response
     {
         $repo->remove($c,true);
         return $this->redirectToRoute('cart', [], Response::HTTP_SEE_OTHER);
     }

    //  /**
    //   * @Route("/checkout", name="checkout")
    //   */
    //  public function checkout(CategoryRepository $brand, OrderRepository $order, CartRepository $repo, OrderDetailRepository $orderdetail, ProductRepository $pro, UserRepository $user): Response
    //  {
    //     //insert  to order
    //     $BR = $brand->findAll();
    //     $order1= new Order();
    //     $user = $this->getUser();
    //     $data[]=[
    //         'id'=>$user->getId()
    //     ];
    //     $id = $data[0]['id'];
    //     $order1->setUserorder($user);
    //     $product = $repo->cart($id);
    //     $totalAll = 0;
    //     foreach ($product as $p) {
    //         $totalAll += $p['total'];
    //     }
    //     $order1->setTotal($totalAll);
    //     $order1->setDatecreate(new \Datetime());
    //     $order->add($order1, true);
        
    //     // insert to orderdetail
    //     $oid = $order->findorderdetail($id)[0]['oid'];
    //     $orderobject =$order->find($oid);
    //     // $date =$order->date($oid);

         
    //     $carts_uid = $repo->findcart($id);
        
    //     foreach ($carts_uid as $c){
    //         $orderdetail1 = new OrderDetail();
    //         $product = $c['id'];
    //         $productobject = $pro->find($product);
    //         $quantity = $c['quantity'];
    //         $orderdetail1->setOrderid($orderobject);
    //         $orderdetail1->setProduct($productobject);
    //         $orderdetail1->setQuantity($quantity);
    //         $orderdetail->add($orderdetail1,true);
    //     }
    //     $delete = $repo->finduserid($id);
    //     foreach( $delete as $d){
    //         $idcat = $d['id'];
    //         $deleteproductcart = $repo->find($idcat);  
    //         $repo->remove($deleteproductcart,true);
    //     }
        

    //     //create view
    //     $userinfo = $order->findByUser($id);
    //     $productdetail = $orderdetail->product($oid);
        

    //     return $this->redirectToRoute('lastbill', [ 'brand' => $BR,'oid'=>$oid, 'total'=>$totalAll, 'userinfo'=>$userinfo,               'productdetail'=>$productdetail
    //     ,'date'=>$date], Response::HTTP_SEE_OTHER);
    //  }


    //  /**
    //   * @Route("/bill", name="app_bill")`
    //   */
    //  public function lastbill(CategoryRepository $brand, OrderRepository $order, CartRepository $repo, OrderDetailRepository $orderdetail, ProductRepository $pro,
    //  UserRepository $user): Response
    //  {
        
    //     $BR = $brand->findAll();
    //     $user = $this->getUser();
    //     $data[]=[
    //         'id'=>$user->getId()
    //     ];
    //     $id = $data[0]['id'];
    //     $oid = $order->orderdetail($id)[0]['oid'];
    //     $userinfo = $order->userinfo($id);
    //     $productdetail = $orderdetail->productdetail($oid);
    //     $product = $repo->cart($id);
    //     $totalAll = 0;
    //     foreach ($product as $p) {
    //         $totalAll += $p['total'];
    //     }
    //     $date =$order->date($oid);
    //      return $this->render('bill/bill.html.twig', [
    //         'brand' => $BR,'oid'=>$oid, 'total'=>$totalAll, 'userinfo'=>$userinfo,'productdetail'=>$productdetail
    //         ,'date'=>$date
    //      ]);
    //  }
}