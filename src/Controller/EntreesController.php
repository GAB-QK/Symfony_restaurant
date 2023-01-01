<?php

namespace App\Controller;

use App\Entity\Entrees;
use App\Entity\Menu;
use App\Form\EntreesType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;



class EntreesController extends AbstractController
{
  #[Route('/entrees/create/{id}', name: 'entrees_create')]
  public function create(Request $request, ManagerRegistry $doctrine, int $id): Response
  {
    $entrees = new Entrees();
    $form = $this->createForm(EntreesType::class, $entrees);
    $form->handleRequest($request);

    $menuRepository = $doctrine->getRepository(Menu::class);
    $menu = $menuRepository->find($id);
    $entrees->setMenu($menu);
    if ($form->isSubmitted() && $form->isValid()) {
      dump($entrees);
      $em = $doctrine->getManager();
      $em->persist($entrees);
      $em->flush();
      // return $this->redirectToRoute("entrees_readAll");
    }
    return $this->render('entrees/form.html.twig', [
      'form' => $form->createView()
    ]);
  }

  #[Route('/entrees/read/{id}', name: 'entrees_read')]
  public function read(Entrees $entrees)
  {
    return $this->render('entrees/read.html.twig', [
      'entrees' => $entrees
    ]);
  }

  #[Route('/entrees/update/{id}', name: 'entrees_update')]
  public function update(Entrees $entrees, Request $request, ManagerRegistry $doctrine): Response
  {
    $form = $this->createForm(EntreesType::class, $entrees);
    $form->handleRequest($request);
    if ($form->isSubmitted() && $form->isValid()) {
      dump($entrees);
      $em = $doctrine->getManager();
      $em->flush();
    }
    return $this->render('entrees/form.html.twig', [
      'form' => $form->createView()
    ]);
  }

  #[Route('/entrees/readAll', name: 'entrees_readAll')] // accolades pour parametres
  public function readAll(ManagerRegistry $doctrine)
  {
    $entreesRepository = $doctrine->getRepository(Entrees::class);
    return $this->render('entrees/readAll.html.twig', [
      'lists' => $entreesRepository->findAll()
    ]);
  }
  #[Route('/entrees/delete/{id}', name: 'entrees_delete')]
  public function delete(Entrees $entrees, ManagerRegistry $doctrine)
  {

    $em = $doctrine->getManager();
    $em->remove($entrees);
    $em->flush();
    return $this->redirectToRoute("entrees_readAll");
  }
}
