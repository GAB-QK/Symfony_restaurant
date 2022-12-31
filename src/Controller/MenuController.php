<?php

namespace App\Controller;

use App\Entity\Menu;
use App\Form\MenuType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class MenuController extends AbstractController
{
  #[Route("/menu/read/{id}", name: "read_menu")]
  public function read(Menu $menu)
  {
    $drinks = $menu->getDrink();
    $desserts = $menu->getDessert();
    $entrees = $menu->getEntrees();
    $plats = $menu->getPlat();

    return $this->render("/menu/read.html.twig", [
      "drinks" => $drinks, "desserts" => $desserts, "entrees" => $entrees, "plats" => $plats, 'menu' => $menu
    ]);
  }

  #[Route('/menu/create', name: 'menu_create')]

  public function create(Request $request, ManagerRegistry $doctrine): Response
  {
    $menu = new Menu();
    $form = $this->createForm(MenuType::class, $menu);
    $form->handleRequest($request);
    if ($form->isSubmitted() && $form->isValid()) {
      dump($menu);
      $em = $doctrine->getManager();
      $em->persist($menu);
      $em->flush();
      //return $this->redirectToRoute("menu_readAll");
    }
    return $this->render('menu/form.html.twig', [
      'form' => $form->createView()
    ]);
  }
}
