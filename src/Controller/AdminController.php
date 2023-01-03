<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\User;
use Doctrine\Persistence\ManagerRegistry;


class AdminController extends AbstractController
{
    #[Route('/admin', name: 'app_admin')]
    public function index(): Response
    {
        return $this->render('admin/index.html.twig', [
            'controller_name' => 'AdminController',
        ]);
    }


    #[Route('/controluser', name: 'app_user')]
    public function usersList(ManagerRegistry $doctrine)
{
    $this->denyAccessUnlessGranted("ROLE_ADMIN");
    $userRepository = $doctrine->getRepository(User::class);
    $users =$userRepository->findAll();
    return $this->render('admin/user.html.twig', [
        "users" => $users
    ]);
}

#[Security("is_granted('ROLE_ADMIN')")]

    #[Route("/user/readAll")]

    public function readAll(ManagerRegistry $doctrine)

    {

        $userRepository = $doctrine->getRepository(User::class);

        return $this->render("user/readAll.html.twig", [

            "users" => $userRepository->findAll()

        ]);

        return $this->redirectToRoute("index");

    }
}
