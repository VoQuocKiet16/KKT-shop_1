<?php

namespace App\Controller;

use App\Repository\CategoryRepository;
use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/home", name="app_home")
     */
    public function index(CategoryRepository $repo1): Response
    {
        $br = $repo1->findAll();
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
            'brand' => $br
        ]);
    }



    //search controller
    /**
     * @Route("/search", name="search", methods={"GET"})
     */
    public function actionSearch(Request $req, ProductRepository $repo, CategoryRepository $repo1): Response
    {
        $br = $repo1->findAll();
        $sName = $req->query->get("search");
        $product = $repo->findBysearchproduct($sName);
        return $this->render('search/index.html.twig', [
            'pro' => $product,
            'brand' => $br
        ]);
    }
}
