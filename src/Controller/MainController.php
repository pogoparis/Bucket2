<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    #[Route('/', name: 'app_main_home')]
    public function home(): Response
    {
        return $this->render('main/index.html.twig', [
            'controller_name' => 'MainController',
        ]);
    }

    #[Route('/about', name: 'app_main_about')]
    public function about(): Response
    {
        return $this->render('main/about.html.twig', [
            'controller_name' => 'MainController',
        ]);
    }
}
