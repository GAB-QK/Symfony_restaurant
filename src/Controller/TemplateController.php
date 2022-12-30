<?php

namespace App\Controller;

use App\Entity\Template;
use App\Form\TemplateType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;



class TemplateController extends AbstractController
{
  #[Route('/template/create', name: 'template_create')]
  public function create(Request $request, ManagerRegistry $doctrine): Response
  {
    $template = new Template();
    $form = $this->createForm(TemplateType::class, $template);
    $form->handleRequest($request);
    if ($form->isSubmitted() && $form->isValid()) {
      dump($template);
      $em = $doctrine->getManager();
      $em->persist($template);
      $em->flush();
      //return $this->redirectToRoute("template_readAll");
    }


    return $this->render('template/form.html.twig', [
      'form' => $form->createView()
    ]);
  }

  #[Route('/template/read/{id}', name: 'template_read')]
  public function read(Template $template)
  {
    return $this->render('template/read.html.twig', [
      'template' => $template
    ]);
  }

  #[Route('/template/update/{id}', name: 'template_update')]
  public function update(Template $template, Request $request, ManagerRegistry $doctrine): Response
  {
    $form = $this->createForm(TemplateType::class, $template);
    $form->handleRequest($request);
    if ($form->isSubmitted() && $form->isValid()) {
      dump($template);
      $em = $doctrine->getManager();
      $em->flush();
    }


    return $this->render('template/form.html.twig', [
      'form' => $form->createView()
    ]);
  }

  #[Route('/template/readAll', name: 'template_readAll')] // accolades pour parametres
  public function readAll(ManagerRegistry $doctrine)
  {
    $TemplateRepository = $doctrine->getRepository(Template::class);
    return $this->render('template/readAll.html.twig', [
      'lists' => $TemplateRepository->findAll()
    ]);
  }
  #[Route('/template/delete/{id}', name: 'template_delete')]
  public function delete(Template $template, ManagerRegistry $doctrine)
  {

    $em = $doctrine->getManager();
    $em->remove($template);
    $em->flush();
    return $this->redirectToRoute("template_readAll");
  }
}
