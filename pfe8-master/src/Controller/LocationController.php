<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Classe\Mail;

class LocationController extends AbstractController
{
    #[Route('/location', name: 'app_location')]
    public function index(): Response
    {
        $mail=new Mail();
        $mail->send('west12@outlook.fr','west world','Mon premier mail','votre probleme est resolue');
        return $this->render('location/index.html.twig');
    }
}
