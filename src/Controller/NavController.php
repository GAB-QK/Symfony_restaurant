<?php

namespace App\Controller;

use App\Entity\Menu;
use App\Entity\Template;
use App\Repository\TemplateRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class NavController extends AbstractController
{
    #[Route('/templates', name: 'templates')]
    public function templates(ManagerRegistry $doctrine, Request $request, TemplateRepository $repository): Response
    {
        $sortBy = $request->query->get('sortBy');
        $sortDirection = $request->query->get('sortDirection');

        $templates = $repository->findAll();
        $searchedValue = $request->query->get('searchedValue');
        if ($searchedValue === NULL) {
            // si recherche vide
        } else {
            $nametemplates = $repository->findBy(['name' => $searchedValue]);
            $tagtemplates = $repository->findBy(['tag' => $searchedValue]);

            $templates = array_merge($nametemplates, $tagtemplates);
        }

        if ($sortBy !== NULL && $sortDirection !== NULL) {
            $templates = $repository->findBy([], [$sortBy => $sortDirection]);
        }

        return $this->render('redirect/templates.html.twig', [
            'templates' => $templates,
            'searchedValue' => $searchedValue,
            'sortBy' => $sortBy,
            'sortDirection' => $sortDirection,
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
