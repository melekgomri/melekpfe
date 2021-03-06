<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class Main1Controller extends AbstractController
{
    #[Route('/app_home', name: 'app_home')]
    public function index(): Response
    {
        return $this->render('main1/index.html.twig', [
            'controller_name' => 'Main1Controller',
        ]);
    }
}
