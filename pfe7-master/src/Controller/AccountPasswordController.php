<?php

namespace App\Controller;
use App\Form\ChangepasswordType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AccountPasswordController extends AbstractController
{
    #[Route('/account/password', name: 'account_password')]
    public function index(Request $request , UserPasswordHasherInterface $encodeur,EntityManagerInterface $doctrine): Response
    {
        $notification=null;
        $user=$this->getUser();
        $form=$this->createForm(ChangepasswordType::class,$user);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $old_pwd=$form->get('old_password')->getData();
           
            if ($encodeur->isPasswordValid( $user,$old_pwd)){
                $new_pwd=$form->get('new_password')->getData();
                $password=$encodeur->hashPassword($user,$new_pwd);
                $user->setPassword($password);
                $doctrine->persist($user);
            $doctrine->flush();
            $notification="votre mot de passe a ete bien mise a jour";
    
            }else{
                $notification="votre mot de passe n'est pas le bons";
            }
    
        
    }
        return $this->render('account/password.html.twig',[
            'form'=>$form->createView(),
            'notification' => $notification
        ]);
    }
}
