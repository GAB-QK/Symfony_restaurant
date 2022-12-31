<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class NavController extends AbstractController
{
    #[Route('/templates', name: 'templates')]
    public function templates(): Response
    {
        return $this->render('/redirect/templates.html.twig');
    }

    #[Route('/menu', name: 'menu')]
    public function projet(): Response
    {
        return $this->render('/redirect/menu.html.twig');
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
