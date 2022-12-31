<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\UserRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class WelcomeController extends AbstractController
{
  public function index(ManagerRegistry $doctrine, User $id)
  {
    $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
    $UserRepository = $doctrine->getRepository(User::class);
    $user = $UserRepository->find($id);


    //$user = $this->getUser();
    return new Response('Bienvenue ' . $user->getUserName());
  }
}
