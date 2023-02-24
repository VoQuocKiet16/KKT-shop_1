<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\EditProfileType;
use App\Form\UserType;
use App\Repository\CategoryRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{  
    /**
    * @Route("/", name="app_login")
    */

    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        // $br = $brand->findAll();
        // if ($this->getUser()) {
        //     return $this->redirectToRoute('target_path');
        // }

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('security/login.html.twig', ['last_username' => $lastUsername, 'error' => $error
        // , 'brand' => $br
    ]);
    }

    /**
    * @Route("/logout", name="app_logout")
    */
    // #[Route(path: '/logout', name: 'app_logout')]
    public function logout(): void
    {
        throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
    }
    
    //   /**
    //      * @Route("/profile", name="app_profilee")
    //      */
    //     public function readAllAction(UserRepository $upUser): Response
    //     {
    //         $user = $this->getUser();
    //         $form = $this->createForm(EditProfileType::class, $user);
    //         return $this->render('profile/form.html.twig', [
    //             'form' => $form->createView(),
    //             'user' => $user
    //         ]);
    //     }

       //EDIT Profile
    /**
     * @Route("/profile", name="app_profile")
     */
    public function Profile(UserRepository $upUser, Request $req): Response
    {
        $u = $this->getUser();
        $form = $this->createForm(EditProfileType::class, $u);

        $form->handleRequest($req);
        if ($form->isSubmitted() && $form->isValid()) {
            $upUser->add($u, true);
            return $this->redirectToRoute('app_profile', [], Response::HTTP_SEE_OTHER);
        }

        // $data[]=[
        //     'id'=>$user->getId()
        // ];
        // $id = $data[0]['id'];
        // $user = $upUser->findByProfile($id);
        return $this->render('profile/form.html.twig', [
            'form' => $form->createView(),
            // 'user' => $user
        ]);
    }

    // /**
    //  * @Route("/profile/update{id}", name="profileUp")
    //  */
    // public function upProfile( UserRepository $upUser, Request $req, User $u): Response
    // {   $name = $req->query->get('name');
    //     $address= $req->query->get('address');
    //     $phone= $req->query->get('phone');
    //     $u->setName($name);
    //     $u->setAddress($address);
    //     $u->setPhone($phone);
    //     $upUser->add($u, true);
    //     return $this->redirectToRoute('app_profile', [], Response::HTTP_SEE_OTHER);
    // }

 
}
