<?php

namespace App\Controller;

use App\Entity\User;
use App\Classe\Mail;
use App\Form\RegisterType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class RegisterController extends AbstractController
{
    private $entityManager;
    #[Route('/register', name: 'register')]
    public function index(Request $request, EntityManagerInterface $doctrine,UserPasswordHasherInterface $encodeur): Response
    {
        $mail=new Mail();
        $mail->send('malekgomri881@hotmail.com','ala mab1','Mon premier email','votre reclation en cours de traitement ');
        $notification=null;
        $user=new User();
        $form = $this->createForm(RegisterType::class, $user);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
        $user=$form->getData();
        $search_email =$this->entityManager->getRepository(User::class)->findOneByEmail($user->getEmail());
        if(!$search_email){
            $user->setPassword($encodeur->hashPassword($user,$form->
            get('password')-> getData()));
                    $doctrine->persist($user);
                    $doctrine->flush();
                    $notification="votre inscription s'est correctement déroulée .Vous pouvez dès a present vous connecter a votr compte";
        }else{
            $notification="l'email que vous avez renseigné existe deja";
        }
        }

        return $this->render('register/index.html.twig',[
            'form' =>$form->createView(),
            'notification'=>$notification
        ]);
    }
}
