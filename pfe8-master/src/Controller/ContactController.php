<?php

namespace App\Controller;
use App\Entity\Contact;
use App\Form\ContactType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use App\Classe\Mail;

class ContactController extends AbstractController
{ 
    #[Route('/contact', name: 'app_contact')]
    public function index(Request $request, EntityManagerInterface $doctrine): Response
    {
       $notification=null;
        $contact=new Contact();
        $form = $this->createForm(ContactType::class, $contact);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $contact=$form->getData();
            $doctrine->persist($contact);
            $doctrine->flush();
            $notification="votre probleme va etre bientot resolut ,Mercie ";
            $mail=new Mail();
        $mail->send('west12@outlook.fr','west world','Mon premier mail','votre probleme est resolue');
        }
        return $this->renderForm('contact/index.html.twig', [
            'controller_name' => 'ContactController',
            'form' =>$form,
            'notification'=>$notification
        ]);
    }
}
