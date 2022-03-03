<?php

namespace App\Controller;

use App\Repository\ProductRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class CartController extends AbstractController
{
    #[Route('/mon-panier', name: 'cart')]
    public function index(SessionInterface $session,ProductRepository $productRepository): Response
    {
        $panier=$session->get('panier',[]);
        $panierWithData=[];
        foreach($panier as $id => $quantity){
            $panierWithData[]=[
                'product'=>$productRepository->find($id),
                'quantity'=>$quantity
            ];
        }
        return $this->render('cart/index.html.twig',[
            'items'=>$panierWithData
        ]);
    }
    #[Route('/cart/add/{id}', name: 'add_to_cart')]
    public function add(SessionInterface $session,$id): Response
    {
       
        $panier=$session->get('panier',[]);
        if(!empty($panier[$id])){
            $panier[$id]++;
        }else{
            $panier[$id]=1;
        }
        $session->set('panier',$panier);
      return $this->redirectToRoute('cart');
    }
    #[Route('/cart/remove/{id}', name: 'remove_my_cart')]
    public function remove(SessionInterface $session,$id): Response
    {
         $panier=$session->get('panier',[]);
         if(!empty($panier[$id])){
             unset($panier[$id]);
         }
         $session->set('panier',$panier);
        return $this->redirectToRoute('products');
    }
}
