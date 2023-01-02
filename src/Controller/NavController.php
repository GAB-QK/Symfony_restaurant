<?php

namespace App\Controller;

use App\Entity\Menu;
use App\Entity\Template;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class NavController extends AbstractController
{
    #[Route('/templates', name: 'templates')]
    public function templates(ManagerRegistry $doctrine): Response
    {
        $templateRepository = $doctrine->getRepository(Template::class);
        return $this->render('redirect/templates.html.twig', [
            'templates' => $templateRepository->findAll()
        ]);
    }

    #[Route('/menu', name: 'menu')]
    public function projet(ManagerRegistry $doctrine): Response
    {
        $menuRepository = $doctrine->getRepository(Menu::class);
        return $this->render('redirect/menu.html.twig', [
            'menus' => $menuRepository->findAll()
        ]);
    }

    #[Route('/abonnement', name: 'abonnement')]
    public function abonnement(): Response
    {
        return $this->render('/redirect/abonnement.html.twig');
    }

    #[Route('/contact', name: 'contact')]
    public function contact(): Response
    {
        return $this->render('/redirect/contact.html.twig');
    }
}
