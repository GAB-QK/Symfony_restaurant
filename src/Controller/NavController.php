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
}
