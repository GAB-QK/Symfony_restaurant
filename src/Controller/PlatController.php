<?php

namespace App\Controller;

use App\Entity\Plat;
use App\Form\PlatType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;



class PlatController extends AbstractController
{
  #[Route('/plat/create', name: 'plat_create')]
  public function create(Request $request, ManagerRegistry $doctrine): Response
  {
    $plat = new Plat();
    $form = $this->createForm(PlatType::class, $plat);
    $form->handleRequest($request);
    if ($form->isSubmitted() && $form->isValid()) {
      dump($plat);
      $em = $doctrine->getManager();
      $em->persist($plat);
      $em->flush();
      return $this->redirectToRoute("plat_readAll");
    }


    return $this->render('plat/form.html.twig', [
      'form' => $form->createView()
    ]);
  }

  #[Route('/plat/read/{id}', name: 'plat_read')]
  public function read(Plat $plat)
  {
    return $this->render('plat/read.html.twig', [
      'plat' => $plat
    ]);
  }

  #[Route('/plat/update/{id}', name: 'plat_update')]
  public function update(Plat $plat, Request $request, ManagerRegistry $doctrine): Response
  {
    $form = $this->createForm(PlatType::class, $plat);
    $form->handleRequest($request);
    if ($form->isSubmitted() && $form->isValid()) {
      dump($plat);
      $em = $doctrine->getManager();
      $em->flush();
    }


    return $this->render('plat/form.html.twig', [
      'form' => $form->createView()
    ]);
  }

  #[Route('/plat/readAll', name: 'plat_readAll')] // accolades pour parametres
  public function readAll(ManagerRegistry $doctrine)
  {
    $PlatRepository = $doctrine->getRepository(Plat::class);
    return $this->render('plat/readAll.html.twig', [
      'lists' => $PlatRepository->findAll()
    ]);
  }
  #[Route('/plat/delete/{id}', name: 'plat_delete')]
  public function delete(Plat $plat, ManagerRegistry $doctrine)
  {

    $em = $doctrine->getManager();
    $em->remove($plat);
    $em->flush();
    return $this->redirectToRoute("plat_readAll");
  }
}
