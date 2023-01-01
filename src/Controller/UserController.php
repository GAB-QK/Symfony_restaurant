<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;



class UserController extends AbstractController
{
  private $passwordHasher;
  public function __construct(UserPasswordHasherInterface $passwordHasher)
  {
    $this->passwordHasher = $passwordHasher;
  }
  #[Route('/user/create', name: 'User_create')]
  public function create(Request $request, ManagerRegistry $doctrine): Response
  {
    $user = new User($this->passwordHasher);
    $form = $this->createForm(UserType::class, $user);
    $form->handleRequest($request);
    if ($form->isSubmitted() && $form->isValid()) {
      dump($user);
      $em = $doctrine->getManager();
      $em->persist($user);
      $em->flush();
      //return $this->redirectToRoute("user_readAll");
    }


    return $this->render('user/form.html.twig', [
      'form' => $form->createView()
    ]);
  }

  #[Route('/user/read/{id}', name: 'user_read')]
  public function read(User $user)
  {
    return $this->render('user/read.html.twig', [
      'user' => $user
    ]);
  }

  #[Route('/user/update/{id}', name: 'user_update')]
  public function update(User $user, Request $request, ManagerRegistry $doctrine): Response
  {
    $form = $this->createForm(UserType::class, $user);
    $form->handleRequest($request);
    if ($form->isSubmitted() && $form->isValid()) {
      dump($user);
      $em = $doctrine->getManager();
      $em->flush();
    }


    return $this->render('user/form.html.twig', [
      'form' => $form->createView()
    ]);
  }

  #[Route('/user/readAll', name: 'user_readAll')]
  // accolades pour parametres
  public function readAll(ManagerRegistry $doctrine)
  {
    $UserRepository = $doctrine->getRepository(User::class);
    return $this->render('user/readAll.html.twig', [
      'lists' => $UserRepository->findAll()
    ]);
  }
  #[Route('/user/delete/{id}', name: 'user_delete')]
  public function delete(User $user, ManagerRegistry $doctrine)
  {

    $em = $doctrine->getManager();
    $em->remove($user);
    $em->flush();
    return $this->redirectToRoute("user_readAll");
  }
}
