<?php

namespace App\Controller;

use App\Entity\Boisson;
use App\Entity\Menu;
use App\Form\BoissonType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;



class BoissonController extends AbstractController
{

  #[Route('/boisson/create/{id}', name: 'boisson_create')]
  public function create(Request $request, ManagerRegistry $doctrine, int $id): Response
  {
    $boisson = new Boisson();
    $form = $this->createForm(BoissonType::class, $boisson);
    $form->handleRequest($request);

    $menuRepository = $doctrine->getRepository(Menu::class);
    $menu = $menuRepository->find($id);
    $boisson->setMenu($menu);
    if ($form->isSubmitted() && $form->isValid()) {
      dump($boisson);
      $em = $doctrine->getManager();
      $em->persist($boisson);
      $em->flush();
      return $this->redirectToRoute("boisson_readAll");
    }
    return $this->render('boisson/form.html.twig', [
      'form' => $form->createView()
    ]);
  }

  #[Route('/boisson/read/{id}', name: 'boisson_read')]
  public function read(Boisson $boisson)
  {
    return $this->render('boisson/read.html.twig', [
      'boisson' => $boisson
    ]);
  }

  #[Route('/boisson/update/{id}', name: 'boisson_update')]
  public function update(Boisson $boisson, Request $request, ManagerRegistry $doctrine): Response
  {
    $form = $this->createForm(BoissonType::class, $boisson);
    $form->handleRequest($request);
    if ($form->isSubmitted() && $form->isValid()) {
      dump($boisson);
      $em = $doctrine->getManager();
      $em->flush();
    }


    return $this->render('boisson/form.html.twig', [
      'form' => $form->createView()
    ]);
  }

  #[Route('/boisson/readAll', name: 'boisson_readAll')] // accolades pour parametres
  public function readAll(ManagerRegistry $doctrine)
  {
    $boissonRepository = $doctrine->getRepository(Boisson::class);
    return $this->render('boisson/readAll.html.twig', [
      'lists' => $boissonRepository->findAll()
    ]);
  }

  #[Route('/boisson/delete/{id}', name: 'boisson_delete')]
  public function delete(Boisson $boisson, ManagerRegistry $doctrine)
  {

    $em = $doctrine->getManager();
    $em->remove($boisson);
    $em->flush();
    return $this->redirectToRoute("boisson_readAll");
  }
}
