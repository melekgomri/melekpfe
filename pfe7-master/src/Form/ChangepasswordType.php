<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;

class ChangepasswordType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email',EmailType::class,[
                'disabled'=>'true',
                'label'=>'mon adresse email'
            ])
           
            ->add('firstname',TextType::class,[
                'disabled'=>'true',
                'label'=>'mon prenom'
            ])
            ->add('lastname',TextType::class,[
                'disabled'=>'true',
                'label'=>'mon nom'
            ])
            ->add('old_password',PasswordType::class,[
                'mapped'=>false,
                'label'=>'mon mot de passe actuel',
                'attr'=>['placeholder'=>'veuillez saisir votre mot de passe actuelle']
        
            ])
            ->add('new_password',RepeatedType::class,[
                'mapped'=>false,
                'invalid_message'=>'le mot de passe et la confiramation doivent etre identique',
                'label'=>'Mon nouveau mot de passe',
                'required'=>'true',
                'first_options'=>[
                    'label'=>'Mot de passe',
                    'attr'=>['placeholder'=>'mercie de saisir votre mot de passe']

                ],
                'second_options'=>[
                    'label'=>'confirmez votre mot de passe',
                    'attr'=>['placeholder'=>'mercie de saisir votre mot de passe']

                ]
                ])
                ->add('submit',SubmitType::class,[
                    'label'=>'Mettre a jour'
                ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
