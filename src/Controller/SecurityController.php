<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{
  #[Route("/login", name: "login")]
  public function login(AuthenticationUtils $utils)
  {
    $error = $utils->getLastAuthenticationError();
    $lastUsername = $utils->getLastUsername();

    return $this->render("security/login.html.twig", [
      "last_username" => $lastUsername,
      "error" => $error,
    ]);
  }

  #[Route("/disconect", name: "disconnect")]
  public function logout()
  {
    return $this->render('/redirect/index.html.twig');
  }
}
