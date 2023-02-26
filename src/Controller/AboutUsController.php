<?php

namespace App\Controller;

use App\Repository\CategoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AboutUsController extends AbstractController
{
    /**
     * @Route("/aboutus", name="app_about_us")
     */
    public function actionAboutus(CategoryRepository $brand): Response
    {
        $br = $brand->findAll();
        return $this->render('product/aboutus.html.twig', [
            'controller_name' => 'AboutUsController',
            'brand'=>$br,
        ]);
    }
}