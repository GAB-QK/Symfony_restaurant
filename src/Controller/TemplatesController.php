<?php

// src/Controller/TemplateController.php

namespace App\Controller;

use App\Entity\Template;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class TemplateController extends AbstractController
{
    /**
     * @Route("/templates", name="template_list")
     */
    public function list()
    {
        // fetch the templates from the database
        $templates = $this->getDoctrine()
            ->getRepository(Template::class)
            ->findAll();

        // render the template list view
        return $this->render('template/list.html.twig', [
            'templates' => $templates,
        ]);
    }
}
