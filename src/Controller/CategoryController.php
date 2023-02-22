<?php

namespace App\Controller;

use App\Entity\Category;
use App\Repository\CategoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CategoryController extends AbstractController
{
    private CategoryRepository $repo;
    public function __construct(CategoryRepository $repo)
    {
       $this->repo = $repo;
    }
    /**
     * @Route("/categoryy", name="category_show")
     */
    public function allCategoryAction(): Response
    {
        $category = $this->repo->findAll();
        return $this->render('category/index.html.twig', [
            'category'=>$category
        ]);
    }

    //ADMIN
    //ADD Category
    /**
     * @Route("/addcate", name="category_create")
     */
    public function addCategoryAction(CategoryRepository $repo, Request $req): Response
    {
        $cate = new Category();
        $form = $this->createForm(CategoryType::class, $cate);

        $form->handleRequest($req);
        if($form->isSubmitted()&& $form->isValid())
        {
            $repo->add($cate, true);
            return $this->redirectToRoute('category_show', [], Response::HTTP_SEE_OTHER);
        }
        return $this->render('category/form.html.twig',[
            'form'=>$form->createView()
        ]);
    }

}
