<?php

namespace App\Controller;

use App\Entity\Dessert;
use App\Form\DessertType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;



class DessertController extends AbstractController
{
  #[Route('/dessert/create{id}', name: 'dessert_create')]
  public function create(Request $request, ManagerRegistry $doctrine, int $id): Response
  {
    $dessert = new Dessert();
    $form = $this->createForm(DessertType::class, $dessert);
    $form->handleRequest($request);

    $menuRepository = $doctrine->getRepository(Menu::class);
    $menu = $menuRepository->find($id);
    $dessert->setMenu($menu);
    if ($form->isSubmitted() && $form->isValid()) {
      dump($dessert);
      $em = $doctrine->getManager();
      $em->persist($dessert);
      $em->flush();
      //return $this->redirectToRoute("dessert_readAll");
    }


    return $this->render('dessert/form.html.twig', [
      'form' => $form->createView()
    ]);
  }

  #[Route('/dessert/read/{id}', name: 'dessert_read')]
  public function read(Dessert $dessert)
  {
    return $this->render('dessert/read.html.twig', [
      'dessert' => $dessert
    ]);
  }

  #[Route('/dessert/update/{id}', name: 'dessert_update')]
  public function update(Dessert $dessert, Request $request, ManagerRegistry $doctrine): Response
  {
    $form = $this->createForm(DessertType::class, $dessert);
    $form->handleRequest($request);
    if ($form->isSubmitted() && $form->isValid()) {
      dump($dessert);
      $em = $doctrine->getManager();
      $em->flush();
    }


    return $this->render('dessert/form.html.twig', [
      'form' => $form->createView()
    ]);
  }

  #[Route('/dessert/readAll', name: 'dessert_readAll')] // accolades pour parametres
  public function readAll(ManagerRegistry $doctrine)
  {
    $dessertRepository = $doctrine->getRepository(Dessert::class);
    return $this->render('dessert/readAll.html.twig', [
      'lists' => $dessertRepository->findAll()
    ]);
  }
  #[Route('/dessert/delete/{id}', name: 'dessert_delete')]
  public function delete(Dessert $dessert, ManagerRegistry $doctrine)
  {

    $em = $doctrine->getManager();
    $em->remove($dessert);
    $em->flush();
    return $this->redirectToRoute("dessert_readAll");
  }
}
